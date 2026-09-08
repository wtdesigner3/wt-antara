<?php
$conn = mysqli_connect('localhost', 'root', '', 'anahat_db');
if (!$conn) {
    die('Database Connection Failed: ' . mysqli_connect_error());
}

// 1. Create tbl_blogs Table
$table_sql = "CREATE TABLE IF NOT EXISTS `tbl_blogs` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_title` varchar(255) NOT NULL,
  `b_url` varchar(255) NOT NULL,
  `b_category` varchar(100) DEFAULT 'Export Insights',
  `author` varchar(100) DEFAULT 'Antara Trade Desk',
  `b_image` varchar(255) DEFAULT NULL,
  `broad_image` varchar(255) DEFAULT NULL,
  `b_short_desc` text DEFAULT NULL,
  `b_description` longtext DEFAULT NULL,
  `b_quote` text DEFAULT NULL,
  `b_quote_author` varchar(150) DEFAULT NULL,
  `b_tags` varchar(255) DEFAULT 'Commodities, Export, Quality QA',
  `read_time` varchar(50) DEFAULT '5 min read',
  `b_date` date DEFAULT NULL,
  `b_status` tinyint(1) DEFAULT 1,
  `b_sort` int(11) DEFAULT 0,
  `metatag` text DEFAULT NULL,
  `metakeyword` text DEFAULT NULL,
  `metadesc` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `b_url` (`b_url`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

mysqli_query($conn, $table_sql) or die("Error creating table: " . mysqli_error($conn));

// Check if records exist
$cnt_res = mysqli_query($conn, "SELECT COUNT(*) as total FROM `tbl_blogs`");
$cnt_row = mysqli_fetch_assoc($cnt_res);

if ($cnt_row['total'] == 0) {
    $posts = [
        [
            'title' => 'The Evolution of Indian Arabica: How Micro-Lots & Altitude Crafting Win European Roasters',
            'url' => 'evolution-of-indian-arabica-coffee-export',
            'category' => 'Coffee Insights',
            'author' => 'Antara Trade Desk',
            'image' => 'assets/img/commodities/hero-specialty-coffee.jpg',
            'short_desc' => 'Exploring how high-altitude estates in Chikmagalur and Baba Budan Giri are producing specialty grade Arabica beans meeting strict European cupping standards.',
            'desc' => '<p class="mb-3">Indian Arabica coffee has undergone a profound transformation over the last decade. Historically recognized for consistent commercial body in espresso blends, Southern India\'s plantation belts—nestled between 1,100 to 1,500 meters above sea level—are now commanding prime attention in specialty cupping tables across Frankfurt, London, and Melbourne.</p><p class="mb-3">Our trade specialists at Antara Globale work directly with certified estate producers across Chikmagalur, Coorg, and Shevaroys. Through calibrated selective hand-picking, anaerobic fermentation trials, and strict moisture stabilization below 11.5%, we deliver washed Plantation A and Specialty Micro-Lot Arabicas that showcase bright citric acidity, cane sweetness, and delicate floral undertones.</p><h3 class="mt-4 mb-3">Quality Parameters for Commercial Export</h3><p class="mb-3">Every export lot undergoes comprehensive green bean grading, screen sizing (Screen 17/18 for Plantation A), and defect count audits adhering to the Coffee Board of India and International Coffee Organization (ICO) benchmarks. Containerization with inner GrainPro liner bags guarantees protection against sea freight humidity fluctuations.</p>',
            'quote' => 'Consistency in screen grading and moisture equilibrium is the true foundation of long-term export relationships.',
            'quote_author' => 'Lead Agronomist, Antara Trade Desk',
            'tags' => 'Arabica, Coffee Export, Specialty Coffee, Quality QA',
            'read_time' => '4 min read',
            'date' => '2026-08-15',
            'sort' => 1
        ],
        [
            'title' => 'Global Spice Sourcing: Verifying Malabar Black Pepper & Alleppey Turmeric Quality',
            'url' => 'global-spice-sourcing-malabar-pepper-turmeric-qa',
            'category' => 'Spice Trade',
            'author' => 'Quality Control Division',
            'image' => 'assets/img/commodities/black-pepper.jpg',
            'short_desc' => 'A master guide to export quality parameters: moisture thresholds, bulk density (GL), and curcumin percentage verification for international port compliance.',
            'desc' => '<p class="mb-3">India remains the world’s undisputed epicenter for botanical potency and high-oil spice cultivation. For international spice importers, food processors, and seasoning houses, understanding rigorous laboratory benchmarks is the only hedge against consignment rejection at destination ports.</p><p class="mb-3">Malabar Black Pepper from Kerala\'s Western Ghats is globally celebrated for its high piperine content (4.5%–6.0%) and robust bulk density (measured in Grams per Liter, or GL 550 to GL 570). Concurrently, Alleppey Finger Turmeric is sought after for its distinctive deep golden-yellow pigment and rich natural curcumin content averaging 5.0% to 5.5%.</p><h3 class="mt-4 mb-3">Physical & Microbiological Rigor</h3><p class="mb-3">Antara Globale enforces multi-stage sorting: pre-cleaning to extract light berries and pinheads, spiral gravity separators for density sorting, and final steam sterilization when specified for European and US FDA microbiological standards.</p>',
            'quote' => 'Quality is not a final inspection step; it begins at the sorting tables in Kochi.',
            'quote_author' => 'QA Director, Antara Globale',
            'tags' => 'Black Pepper, Turmeric, Spices Export, Food Safety',
            'read_time' => '5 min read',
            'date' => '2026-08-28',
            'sort' => 2
        ],
        [
            'title' => 'From Port to Pantry: Supply Chain Best Practices for Commercial HORECA Inflow',
            'url' => 'supply-chain-best-practices-horeca-foodservice',
            'category' => 'HORECA Supply',
            'author' => 'Logistics & Supply Desk',
            'image' => 'assets/img/commodities/shipping-logistics-port.jpg',
            'short_desc' => 'How temperature-monitored warehousing and containerized transit ensure zero degradation for bulk tea, sugar sachets, and barista syrups.',
            'desc' => '<p class="mb-3">Managing high-frequency ingredient supply for luxury hotel chains, multi-location café brands, and commercial cloud kitchens requires zero-tolerance logistics. Downtime or stock inconsistency directly degrades guest satisfaction and brand reputation.</p><p class="mb-3">Antara Globale bridges the gap between agricultural producers and hospitality pantry procurement. By maintaining regional hub warehousing in Bangalore and Mumbai, our clients benefit from palletized consolidation of Veeba condiments, artisanal barista syrups, branded portion-pack sugar sachets, and freshly roasted espresso blends.</p><h3 class="mt-4 mb-3">Scheduled Batch Logistics</h3><p class="mb-3">Our unified procurement SLA guarantees predictable dispatch cycles, computerized batch expiration traceability, and custom private labeling support for enterprise hotel franchises.</p>',
            'quote' => 'Hospitality procurement demands the predictability of a clockwork logistics engine.',
            'quote_author' => 'Operations Head, Antara Globale',
            'tags' => 'HORECA, Hospitality, Supply Chain, Logistics',
            'read_time' => '6 min read',
            'date' => '2026-09-02',
            'sort' => 3
        ]
    ];

    $stmt = mysqli_prepare($conn, "INSERT INTO `tbl_blogs` (`b_title`, `b_url`, `b_category`, `author`, `b_image`, `b_short_desc`, `b_description`, `b_quote`, `b_quote_author`, `b_tags`, `read_time`, `b_date`, `b_status`, `b_sort`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 1, ?)");
    
    foreach ($posts as $p) {
        mysqli_stmt_bind_param($stmt, "ssssssssssssi", 
            $p['title'], 
            $p['url'], 
            $p['category'], 
            $p['author'], 
            $p['image'], 
            $p['short_desc'], 
            $p['desc'], 
            $p['quote'], 
            $p['quote_author'], 
            $p['tags'], 
            $p['read_time'], 
            $p['date'], 
            $p['sort']
        );
        mysqli_stmt_execute($stmt);
    }
    echo "SUCCESS: Created tbl_blogs table and inserted " . count($posts) . " starter blog articles.\n";
} else {
    echo "SUCCESS: tbl_blogs table already exists with " . $cnt_row['total'] . " articles.\n";
}
