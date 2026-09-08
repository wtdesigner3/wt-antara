<?php 
require('checksession.php'); 
require('../inc/function.php');

// 1. Handle CSV Export
if (isset($_GET['export']) && $_GET['export'] == 'csv') {
    $filter_status = isset($_GET['status']) ? mysqli_real_escape_string($conn, $_GET['status']) : '';
    $where_exp = "";
    if ($filter_status != '') {
        $where_exp = "WHERE `status`='$filter_status'";
    }
    $exp_query = mysqli_query($conn, "SELECT * FROM `tbl_enquiry` $where_exp ORDER BY `id` DESC");
    
    $filename = "antara_globale_b2b_leads_" . date('Y-m-d_H-i') . ".csv";
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=' . $filename);
    
    $output = fopen('php://output', 'w');
    // UTF-8 BOM for Excel
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    fputcsv($output, ['Lead ID', 'Full Name', 'Company Name', 'Email', 'Phone', 'Country', 'Division', 'Product Interest', 'Volume Required', 'Message', 'Status', 'Internal Notes', 'Date Submitted']);
    
    while ($row = mysqli_fetch_assoc($exp_query)) {
        fputcsv($output, [
            $row['id'],
            $row['full_name'],
            $row['company_name'],
            $row['email'],
            $row['phone'],
            $row['country'],
            strtoupper($row['division']),
            $row['product_interest'],
            $row['volume_requirement'],
            $row['message'],
            ucwords(str_replace('_', ' ', $row['status'])),
            $row['notes'],
            $row['created_at']
        ]);
    }
    fclose($output);
    exit;
}

$msg = "";
$error = "";

// 2. Handle Status & Notes Change
if (isset($_POST['update_status']) && isset($_POST['enquiry_id'])) {
    $eid = (int)$_POST['enquiry_id'];
    $new_status = mysqli_real_escape_string($conn, $_POST['status']);
    $notes = mysqli_real_escape_string($conn, $_POST['notes'] ?? '');
    $up_q = mysqli_query($conn, "UPDATE `tbl_enquiry` SET `status`='$new_status', `notes`='$notes' WHERE `id`=$eid");
    if ($up_q) {
        $msg = "Lead #$eid updated successfully.";
    } else {
        $error = "Failed to update lead status.";
    }
}

// 3. Handle Quick Inline Status Update via GET
if (isset($_GET['quick_status']) && isset($_GET['id'])) {
    $qid = (int)$_GET['id'];
    $qst = mysqli_real_escape_string($conn, $_GET['quick_status']);
    mysqli_query($conn, "UPDATE `tbl_enquiry` SET `status`='$qst' WHERE `id`=$qid");
    $msg = "Status for Lead #$qid changed to " . str_replace('_', ' ', $qst) . ".";
}

// 4. Handle Delete
if (isset($_GET['delete'])) {
    $del_id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM `tbl_enquiry` WHERE `id`=$del_id");
    $msg = "Inquiry deleted successfully.";
}

// Filter by Status & Division
$filter = isset($_GET['status']) ? mysqli_real_escape_string($conn, $_GET['status']) : '';
$div_filter = isset($_GET['division']) ? mysqli_real_escape_string($conn, $_GET['division']) : '';

$where_clauses = [];
if ($filter != '') $where_clauses[] = "`status`='$filter'";
if ($div_filter != '') $where_clauses[] = "`division`='$div_filter'";

$where = "";
if (count($where_clauses) > 0) {
    $where = "WHERE " . implode(" AND ", $where_clauses);
}

$enquiries = mysqli_query($conn, "SELECT * FROM `tbl_enquiry` $where ORDER BY `id` DESC");

// Fetch counts for tabs
$cnt_all = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as c FROM `tbl_enquiry`"))['c'];
$cnt_pending = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as c FROM `tbl_enquiry` WHERE `status`='pending'"))['c'];
$cnt_discussion = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as c FROM `tbl_enquiry` WHERE `status`='in_discussion'"))['c'];
$cnt_quoted = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as c FROM `tbl_enquiry` WHERE `status`='quoted'"))['c'];
$cnt_closed = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as c FROM `tbl_enquiry` WHERE `status`='closed'"))['c'];
?>
<!DOCTYPE html>
<html lang="en">
<?php require('includes/head.php'); ?>
<body>
	<div id="page-container" class="page-sidebar-fixed page-header-fixed show">
		<?php require('includes/header.php'); ?>
		<?php require('includes/left.php'); ?>
		
		<div id="content" class="content">
			<!-- Header Title & Export Actions -->
			<div class="d-flex flex-wrap align-items-center justify-content-between mb-3 pb-2 border-bottom">
				<div>
					<ol class="breadcrumb mb-1">
						<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
						<li class="breadcrumb-item active">B2B Leads CRM</li>
					</ol>
					<h1 class="page-header mb-0">
						<i class="fa-solid fa-address-book text-warning me-2"></i> B2B Inquiries & Leads CRM
					</h1>
				</div>
				<div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
					<a href="manage-enquiries.php?export=csv<?= ($filter != '') ? '&status='.$filter : '' ?>" class="btn btn-warning fw-bold shadow-sm px-3">
						<i class="fa-solid fa-file-csv me-1"></i> Download CSV Export
					</a>
				</div>
			</div>

			<?php if ($msg != ""): ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="fa-solid fa-circle-check me-2"></i> <?= $msg ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>

			<?php if ($error != ""): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<i class="fa-solid fa-triangle-exclamation me-2"></i> <?= $error ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>

			<!-- Top Controls: Status Tabs & Live Search Box -->
			<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-3">
				<div class="cms-subnav-strip mb-0">
					<a href="manage-enquiries.php" class="cms-subnav-pill <?= ($filter == '') ? 'active' : '' ?>">
						All Leads (<?= $cnt_all ?>)
					</a>
					<a href="manage-enquiries.php?status=pending" class="cms-subnav-pill <?= ($filter == 'pending') ? 'active' : '' ?>">
						<i class="fa-solid fa-clock me-1"></i> Pending (<?= $cnt_pending ?>)
					</a>
					<a href="manage-enquiries.php?status=in_discussion" class="cms-subnav-pill <?= ($filter == 'in_discussion') ? 'active' : '' ?>">
						<i class="fa-solid fa-comments me-1"></i> In Discussion (<?= $cnt_discussion ?>)
					</a>
					<a href="manage-enquiries.php?status=quoted" class="cms-subnav-pill <?= ($filter == 'quoted') ? 'active' : '' ?>">
						<i class="fa-solid fa-file-invoice me-1"></i> Quoted (<?= $cnt_quoted ?>)
					</a>
					<a href="manage-enquiries.php?status=closed" class="cms-subnav-pill <?= ($filter == 'closed') ? 'active' : '' ?>">
						Closed (<?= $cnt_closed ?>)
					</a>
				</div>

				<div class="search-filter-box">
					<i class="fa-solid fa-magnifying-glass"></i>
					<input type="text" id="leadSearchInput" class="form-control" placeholder="Search buyer, company, country, product...">
				</div>
			</div>

			<!-- Inquiries Table Panel -->
			<div class="panel">
				<div class="panel-body p-0">
					<div class="table-responsive">
						<table class="table table-hover mb-0" id="leadsTable">
							<thead>
								<tr>
									<th>ID</th>
									<th>Buyer & Company</th>
									<th>Country</th>
									<th>Division</th>
									<th>Product Interest</th>
									<th>Volume</th>
									<th>Date</th>
									<th>Status</th>
									<th class="text-end">Quick Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php if (mysqli_num_rows($enquiries) > 0): ?>
									<?php while ($row = mysqli_fetch_assoc($enquiries)): ?>
										<?php 
										$clean_phone = preg_replace('/[^0-9]/', '', $row['phone']);
										$wa_greeting = urlencode("Hello " . $row['full_name'] . " (" . $row['company_name'] . "), thank you for contacting Antara Globale regarding your trade requirement for " . $row['product_interest'] . ". We are pleased to assist you with commercial pricing and specifications.");
										$mail_subject = urlencode("Antara Globale Trade Quotation - " . $row['product_interest'] . " (#" . $row['id'] . ")");
										$mail_body = urlencode("Dear " . $row['full_name'] . ",\n\nThank you for reaching out to Antara Globale.\n\nWe have received your requirement for " . $row['product_interest'] . " (Volume: " . $row['volume_requirement'] . ").\n\nOur trade desk is preparing the commercial specifications and origin pricing.\n\nBest regards,\nAntara Globale Trade Desk");
										?>
										<tr class="lead-row">
											<td class="fw-bold">#<?= $row['id'] ?></td>
											<td>
												<div class="fw-bold text-dark search-target"><?= htmlspecialchars($row['full_name']) ?></div>
												<div class="small text-muted search-target"><?= htmlspecialchars($row['company_name']) ?></div>
												<div class="small mt-1 d-flex flex-wrap gap-2">
													<a href="mailto:<?= htmlspecialchars($row['email']) ?>?subject=<?= $mail_subject ?>&body=<?= $mail_body ?>" class="text-decoration-none text-muted" title="Send Email">
														<i class="fa-solid fa-envelope text-primary me-1"></i><?= htmlspecialchars($row['email']) ?>
													</a>
													<span class="text-muted">&bull;</span>
													<a href="tel:<?= htmlspecialchars($row['phone']) ?>" class="text-decoration-none text-muted" title="Call">
														<i class="fa-solid fa-phone text-muted me-1"></i><?= htmlspecialchars($row['phone']) ?>
													</a>
												</div>
											</td>
											<td class="search-target">
												<i class="fa-solid fa-earth-americas text-muted me-1"></i> <?= htmlspecialchars($row['country']) ?>
											</td>
											<td>
												<span class="division-badge <?= ($row['division'] == 'export') ? 'division-export' : 'division-horeca' ?>">
													<?= strtoupper($row['division']) ?>
												</span>
											</td>
											<td class="search-target">
												<div class="fw-semibold text-dark"><?= htmlspecialchars($row['product_interest']) ?></div>
												<div class="small text-muted text-truncate" style="max-width: 220px;" title="<?= htmlspecialchars($row['message']) ?>">
													<?= htmlspecialchars($row['message']) ?>
												</div>
											</td>
											<td><span class="badge bg-light text-dark border"><?= htmlspecialchars($row['volume_requirement']) ?></span></td>
											<td class="small text-muted"><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
											<td>
												<!-- Quick Status Dropdown -->
												<div class="dropdown">
													<?php 
													$st = $row['status'];
													$badgeClass = 'status-pending';
													if ($st == 'in_discussion') $badgeClass = 'status-discussion';
													if ($st == 'quoted') $badgeClass = 'status-quoted';
													if ($st == 'closed') $badgeClass = 'status-closed';
													?>
													<button class="status-pill <?= $badgeClass ?> dropdown-toggle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
														<?= str_replace('_', ' ', $st) ?>
													</button>
													<ul class="dropdown-menu shadow-sm border-0">
														<li><a class="dropdown-item small" href="manage-enquiries.php?quick_status=pending&id=<?= $row['id'] ?>"><i class="fa-solid fa-clock text-warning me-2"></i>Mark Pending</a></li>
														<li><a class="dropdown-item small" href="manage-enquiries.php?quick_status=in_discussion&id=<?= $row['id'] ?>"><i class="fa-solid fa-comments text-primary me-2"></i>Mark In Discussion</a></li>
														<li><a class="dropdown-item small" href="manage-enquiries.php?quick_status=quoted&id=<?= $row['id'] ?>"><i class="fa-solid fa-file-invoice text-success me-2"></i>Mark Quoted</a></li>
														<li><a class="dropdown-item small" href="manage-enquiries.php?quick_status=closed&id=<?= $row['id'] ?>"><i class="fa-solid fa-check text-secondary me-2"></i>Mark Closed</a></li>
													</ul>
												</div>
											</td>
											<td class="text-end">
												<div class="d-inline-flex align-items-center gap-1">
													<?php if (!empty($clean_phone)): ?>
														<a href="https://wa.me/<?= $clean_phone ?>?text=<?= $wa_greeting ?>" target="_blank" class="btn-whatsapp-action" title="WhatsApp Buyer">
															<i class="fa-brands fa-whatsapp"></i> Chat
														</a>
													<?php endif; ?>

													<button type="button" class="btn btn-xs btn-antara" data-bs-toggle="modal" data-bs-target="#inquiryModal<?= $row['id'] ?>" title="View / Edit Lead">
														<i class="fa-solid fa-pen-to-square"></i>
													</button>

													<a href="manage-enquiries.php?delete=<?= $row['id'] ?>" class="btn btn-xs btn-outline-danger" onClick="return confirm('Permanently delete this inquiry?');" title="Delete">
														<i class="fa-solid fa-trash"></i>
													</a>
												</div>
											</td>
										</tr>

										<!-- Action Modal for this Inquiry -->
										<div class="modal fade" id="inquiryModal<?= $row['id'] ?>" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<form method="POST" action="manage-enquiries.php">
														<input type="hidden" name="enquiry_id" value="<?= $row['id'] ?>">
														<div class="modal-header bg-light">
															<div>
																<h5 class="modal-title fw-bold mb-0">Lead #<?= $row['id'] ?> &bull; <?= htmlspecialchars($row['full_name']) ?></h5>
																<small class="text-muted"><?= htmlspecialchars($row['company_name']) ?> &bull; <?= htmlspecialchars($row['country']) ?></small>
															</div>
															<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
														</div>
														<div class="modal-body p-4">
															<!-- Buyer Key Specs Grid -->
															<div class="row g-3 mb-4 p-3 bg-light rounded border">
																<div class="col-md-6">
																	<label class="form-label text-muted small fw-bold mb-1">BUYER EMAIL</label>
																	<div>
																		<a href="mailto:<?= htmlspecialchars($row['email']) ?>" class="fw-semibold text-dark">
																			<i class="fa-solid fa-envelope text-primary me-1"></i><?= htmlspecialchars($row['email']) ?>
																		</a>
																	</div>
																</div>
																<div class="col-md-6">
																	<label class="form-label text-muted small fw-bold mb-1">WHATSAPP / PHONE</label>
																	<div>
																		<?php if (!empty($clean_phone)): ?>
																			<a href="https://wa.me/<?= $clean_phone ?>?text=<?= $wa_greeting ?>" target="_blank" class="fw-bold text-success">
																				<i class="fa-brands fa-whatsapp"></i> <?= htmlspecialchars($row['phone']) ?> (Open Chat)
																			</a>
																		<?php else: ?>
																			<span class="text-dark fw-semibold"><?= htmlspecialchars($row['phone']) ?></span>
																		<?php endif; ?>
																	</div>
																</div>
																<div class="col-md-4">
																	<label class="form-label text-muted small fw-bold mb-1">DIVISION</label>
																	<div>
																		<span class="division-badge <?= ($row['division'] == 'export') ? 'division-export' : 'division-horeca' ?>">
																			<?= strtoupper($row['division']) ?>
																		</span>
																	</div>
																</div>
																<div class="col-md-4">
																	<label class="form-label text-muted small fw-bold mb-1">PRODUCT INTEREST</label>
																	<div class="fw-semibold text-dark"><?= htmlspecialchars($row['product_interest']) ?></div>
																</div>
																<div class="col-md-4">
																	<label class="form-label text-muted small fw-bold mb-1">VOLUME REQUIREMENT</label>
																	<div class="fw-semibold text-dark"><?= htmlspecialchars($row['volume_requirement']) ?></div>
																</div>
															</div>

															<!-- Buyer Note / Message -->
															<div class="mb-4">
																<label class="form-label text-muted small fw-bold">BUYER'S SPECIFICATIONS / NOTE</label>
																<div class="p-3 bg-white rounded border text-dark">
																	<?= nl2br(htmlspecialchars($row['message'])) ?>
																</div>
															</div>

															<hr>

															<!-- Status & Trade Follow-up Notes -->
															<div class="row g-3">
																<div class="col-md-6">
																	<label class="form-label fw-bold">Update Lead Status</label>
																	<select name="status" class="form-select">
																		<option value="pending" <?= ($row['status'] == 'pending') ? 'selected' : '' ?>>Pending (New Lead)</option>
																		<option value="in_discussion" <?= ($row['status'] == 'in_discussion') ? 'selected' : '' ?>>In Discussion</option>
																		<option value="quoted" <?= ($row['status'] == 'quoted') ? 'selected' : '' ?>>Quotation Sent</option>
																		<option value="closed" <?= ($row['status'] == 'closed') ? 'selected' : '' ?>>Closed / Fulfilled</option>
																	</select>
																</div>

																<div class="col-md-12">
																	<label class="form-label fw-bold">Internal Trade Notes / Remarks</label>
																	<textarea name="notes" class="form-control" rows="3" placeholder="Add quotation details, shipping terms (FOB/CIF), pricing per MT, or follow-up logs..."><?= htmlspecialchars($row['notes'] ?? '') ?></textarea>
																	<small class="text-muted">These notes are visible only to the Antara Globale administration team.</small>
																</div>
															</div>
														</div>
														<div class="modal-footer bg-light">
															<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
															<button type="submit" name="update_status" class="btn btn-antara-gold">Save Changes</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									<?php endwhile; ?>
								<?php else: ?>
									<tr>
										<td colspan="9" class="text-center py-5 text-muted">
											<i class="fa-solid fa-inbox fa-3x mb-3 d-block text-muted"></i>
											No trade enquiries found matching criteria.
										</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
		
		<?php require('includes/footer.php'); ?>
	</div>

	<!-- Client-side Instant Search Script -->
	<script>
	document.addEventListener("DOMContentLoaded", function() {
		const searchInput = document.getElementById('leadSearchInput');
		if (searchInput) {
			searchInput.addEventListener('keyup', function() {
				const query = this.value.toLowerCase().trim();
				const rows = document.querySelectorAll('.lead-row');
				rows.forEach(row => {
					const text = row.innerText.toLowerCase();
					if (text.includes(query)) {
						row.style.display = '';
					} else {
						row.style.display = 'none';
					}
				});
			});
		}
	});
	</script>
</body>
</html>
