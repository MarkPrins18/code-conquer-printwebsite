-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 jun 2026 om 11:27
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bouw3d_db`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `catalog_products`
--

CREATE TABLE `catalog_products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(20) NOT NULL,
  `stock_quantity` smallint(5) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `catalog_products`
--

INSERT INTO `catalog_products` (`product_id`, `sku`, `stock_quantity`, `description`, `updated_at`) VALUES
(1, 'CC-STD-001', 115, 'Standard concrete formwork connector for temporary structures', '2026-04-03 13:11:10'),
(2, 'CC-STD-002', 85, 'Durable ventilation grille for HVAC systems', '2026-03-27 07:49:55'),
(3, 'CC-STD-003', 200, 'Weatherproof electrical box cover for outdoor use', '2026-03-27 07:49:55'),
(4, 'CC-STD-004', 60, 'Heavy-duty pipe support bracket for industrial piping', '2026-03-27 07:49:55'),
(5, 'CC-STD-005', 45, 'Corrosion-resistant metal wall anchor for masonry', '2026-03-27 07:49:55'),
(6, 'CC-STD-006', 95, 'Modular drainage channel segment for landscaping', '2026-03-27 07:49:55'),
(7, 'CC-STD-007', 30, 'Lightweight aluminium window latch for modern facades', '2026-03-27 07:49:55'),
(8, 'CC-STD-008', 25, 'High-strength titanium structural node for frameworks', '2026-03-27 07:49:55'),
(9, 'CC-STD-009', 150, '3D printed concrete tile for decorative pathways', '2026-03-27 07:49:55'),
(10, 'CC-STD-010', 180, 'Reinforced nylon dowel for modular construction', '2026-03-27 07:49:55');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `companies`
--

CREATE TABLE `companies` (
  `kvk` char(8) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `companies`
--

INSERT INTO `companies` (`kvk`, `name`, `created_at`, `updated_at`) VALUES
('00112233', 'CleanEnergy Solutions BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('01233210', 'SmartHome Solutions BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('01234567', 'SecureNet BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('11222331', 'AgriVision BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('11223344', 'CloudFlex BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('12344321', 'UrbanPlanning BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('12345678', 'TechNova Solutions BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('22333442', 'DataSecure BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('22334455', 'AgriTech Innovations NV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('23455432', 'SafeGuard Security BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('23456789', 'GreenLeaf Coöperatie', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('33444553', 'BuildSmart BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('33445566', 'HealthFirst BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('34566543', 'TravelEase BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('34567890', 'UrbanBuild NV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('44555664', 'FinTech Partners BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('44556677', 'BuildRight Constructies BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('45677654', 'HomeComfort BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('45678901', 'BrightMind Consultancy BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('55666775', 'MediaWave Coöperatie', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('55667788', 'FinancePro BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('56788765', 'FashionForward NV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('56789012', 'SwiftLogistics BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('66777886', 'AutoService BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('66778899', 'MediaMakers Coöperatie', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('67890123', 'PureWater Technologies NV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('67899876', 'TechWise BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('77888997', 'FreshStart BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('77889900', 'AutoPartners BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('78900987', 'GreenEarth Coöperatie', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('78901234', 'SmartGrow BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('87654321', 'Code & Conquer BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('88990011', 'FreshFood Distributie NV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('88999008', 'EduVision BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('89011098', 'LogiSpeed BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('89012345', 'EcoPack Solutions Coöperatie', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('90122109', 'MedCare BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('90123456', 'DataDrive Analytics BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('99000119', 'CleanTech BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
('99001122', 'EduSmart BV', '2026-03-27 07:49:55', '2026-03-27 07:49:55');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `custom_products`
--

CREATE TABLE `custom_products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `weight_grams` decimal(8,2) NOT NULL,
  `color` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Gegevens worden geëxporteerd voor tabel `custom_products`
--

INSERT INTO `custom_products` (`product_id`, `file_path`, `weight_grams`, `color`, `notes`, `updated_at`) VALUES
(11, 'C:/3D_Print_Orders/TechNova_Solutions/Custom_Facade_Panel.stl', 450.00, 'Grey', 'Engraved with company logo, 3mm thickness', '2026-03-27 07:49:55'),
(12, 'C:/3D_Print_Orders/GreenLeaf_Cooperatie/Custom_Duct_Adapter.stl', 180.50, 'Black', 'Adapted for 150mm diameter piping', '2026-03-27 07:49:55'),
(13, 'C:/3D_Print_Orders/UrbanBuild_NV/Custom_Cable_Tray.stl', 320.00, 'White', 'Modular design for server room', '2026-03-27 07:49:55'),
(14, 'C:/3D_Print_Orders/SwiftLogistics/Custom_Steel_Beam_Connector.stl', 850.00, 'Silver', 'Reinforced for heavy loads', '2026-03-27 07:49:55'),
(15, 'C:/3D_Print_Orders/PureWater_Technologies/Custom_Copper_Pipe_Fitting.stl', 210.75, 'Copper', 'For high-pressure water systems', '2026-03-27 07:49:55'),
(16, 'C:/3D_Print_Orders/SmartGrow/Custom_Carbon_Fiber_Brace.stl', 120.25, 'Black', 'Lightweight support for greenhouse', '2026-03-27 07:49:55'),
(17, 'C:/3D_Print_Orders/EcoPack_Solutions/Custom_Stainless_Steel_Hinge.stl', 380.00, 'Silver', 'Corrosion-resistant for outdoor use', '2026-03-27 07:49:55'),
(18, 'C:/3D_Print_Orders/DataDrive_Analytics/Custom_Inconel_Exhaust_Part.stl', 650.00, 'Grey', 'Heat-resistant for industrial exhaust', '2026-03-27 07:49:55'),
(19, 'C:/3D_Print_Orders/SecureNet/Custom_Geopolymer_Ornament.stl', 95.50, 'Beige', 'Decorative facade element', '2026-03-27 07:49:55'),
(20, 'C:/3D_Print_Orders/CloudFlex/Custom_Wood_Filled_Decor.stl', 110.00, 'Brown', 'For interior design, sanded finish', '2026-03-27 07:49:55');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `materials`
--

CREATE TABLE `materials` (
  `material_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `price_per_gram` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `stock_quantity` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `materials`
--

INSERT INTO `materials` (`material_id`, `name`, `price_per_gram`, `description`, `stock_quantity`) VALUES
(1, 'PLA High Strength', 0.04, 'High-strength PLA for structural components, impact-resistant', 15000.00),
(2, 'PETG Construction Grade', 0.06, 'Durable PETG for outdoor and load-bearing applications', 12000.00),
(3, 'ABS Fire Retardant', 0.07, 'Fire-retardant ABS for safety-critical building parts', 10000.00),
(4, 'Nylon PA6 GF30', 0.12, 'Glass-fiber reinforced nylon for high-strength, lightweight structures', 8000.00),
(5, 'PC (Polycarbonate)', 0.10, 'High-impact polycarbonate for transparent or robust building elements', 9000.00),
(6, 'TPU 95A', 0.09, 'Flexible TPU for seals, gaskets, and vibration-damping components', 7000.00),
(7, 'PVA Support', 0.08, 'Water-soluble support material for complex geometries', 5000.00),
(8, 'HIPS', 0.07, 'High-impact polystyrene for prototypes and lightweight parts', 6000.00),
(9, 'SteelFill (PLA + Steel)', 0.15, 'Metal composite for heavy, durable parts with a metallic finish', 4000.00),
(10, 'BronzeFill (PLA + Bronze)', 0.18, 'Bronze composite for decorative and functional metal-like parts', 3000.00),
(11, 'CopperFill (PLA + Copper)', 0.20, 'Copper composite for conductive and aesthetic applications', 2500.00),
(12, 'Carbon Fiber PLA', 0.25, 'Lightweight, high-strength carbon fiber reinforced PLA', 3500.00),
(13, 'Aluminium (DMLS)', 1.50, 'Direct Metal Laser Sintering aluminium for high-strength, lightweight metal parts', 2000.00),
(14, 'Stainless Steel 316L (DMLS)', 2.00, 'Corrosion-resistant stainless steel for structural and functional metal parts', 1500.00),
(15, 'Titanium Ti6Al4V (DMLS)', 3.50, 'High-strength titanium alloy for critical load-bearing metal components', 1000.00),
(16, 'Inconel 718 (DMLS)', 4.00, 'High-temperature nickel alloy for extreme environments', 800.00),
(17, 'Concrete 3D Print Mix', 0.02, 'Specialized concrete mix for large-scale 3D printed building structures', 50000.00),
(18, 'Geopolymer Concrete', 0.03, 'Eco-friendly geopolymer concrete for sustainable construction', 40000.00),
(19, 'Fiber-Reinforced Concrete', 0.04, 'Fiber-reinforced concrete for enhanced tensile strength', 30000.00),
(20, 'PLA Wood Composite', 0.08, 'Wood-filled PLA for aesthetic and lightweight architectural elements', 7000.00),
(21, 'PLA Recycled', 0.03, '100% recycled PLA for sustainable, non-structural applications', 20000.00),
(22, 'PLA Hi-Temp', 0.05, 'High-temperature resistant PLA for heat-exposed building parts', 9000.00),
(23, 'PLA ESD', 0.09, 'Electrostatic discharge safe PLA for electronic housing in buildings', 6000.00),
(24, 'PLA UV Resistant', 0.06, 'UV-stabilized PLA for outdoor and sun-exposed applications', 11000.00),
(25, 'PETG Chemical Resistant', 0.08, 'Chemical-resistant PETG for harsh environments', 8000.00),
(26, 'ABS High Flow', 0.06, 'High-flow ABS for fast printing of large building components', 10000.00),
(27, 'PA12 (Nylon)', 0.10, 'Durable nylon for functional prototypes and end-use parts', 7500.00),
(28, 'PP (Polypropylene)', 0.07, 'Flexible and chemical-resistant polypropylene for pipes and fittings', 12000.00),
(29, 'PLA Flame Retardant', 0.08, 'Flame-retardant PLA for safety-critical interior building elements', 7000.00),
(30, 'PLA Antimicrobial', 0.10, 'Antimicrobial PLA for hygienic surfaces in healthcare and public buildings', 5000.00),
(31, 'PLA Architectural Matte', 0.05, 'Matte PLA for architectural models', 12000.00),
(32, 'PLA Impact Plus', 0.06, 'Impact resistant PLA for functional prototypes', 11000.00),
(33, 'PLA Glass Fiber', 0.15, 'Glass fiber reinforced PLA for strong prints', 5000.00),
(34, 'PLA Basalt Fiber', 0.16, 'Basalt reinforced PLA for structural components', 4500.00),
(35, 'PLA Stone Composite', 0.09, 'Stone filled PLA for decorative architecture', 6000.00),
(36, 'PLA Marble', 0.10, 'Marble powder filled PLA', 4000.00),
(37, 'PLA Bamboo', 0.08, 'Bamboo fiber PLA for sustainable printing', 5000.00),
(38, 'PLA Cork', 0.07, 'Cork filled PLA for lightweight insulation parts', 5500.00),
(39, 'PLA Aerogel Blend', 0.20, 'Experimental aerogel PLA insulation material', 2000.00),
(40, 'PLA Structural Reinforced', 0.12, 'Reinforced PLA for structural prototypes', 4500.00),
(41, 'PETG Carbon Fiber', 0.20, 'Carbon fiber reinforced PETG', 5000.00),
(42, 'PETG Glass Fiber', 0.18, 'Glass fiber reinforced PETG', 6000.00),
(43, 'PETG UV Stabilized', 0.07, 'UV resistant PETG for outdoor parts', 9000.00),
(44, 'PETG Food Safe', 0.06, 'Food safe PETG material', 8000.00),
(45, 'PETG Clear', 0.07, 'High transparency PETG', 7500.00),
(46, 'PETG Industrial Grade', 0.08, 'Industrial strength PETG', 8500.00),
(47, 'PETG Chemical Resistant', 0.09, 'PETG resistant to chemicals', 6000.00),
(48, 'PETG Recycled', 0.04, 'Recycled PETG filament', 15000.00),
(49, 'PETG High Flow', 0.07, 'Fast printing PETG material', 7000.00),
(50, 'PETG Flame Retardant', 0.10, 'Fire resistant PETG material', 5000.00),
(51, 'ABS Carbon Fiber', 0.20, 'Carbon reinforced ABS', 4500.00),
(52, 'ABS Glass Fiber', 0.18, 'Glass reinforced ABS', 4500.00),
(53, 'ABS UV Resistant', 0.07, 'UV stabilized ABS', 8000.00),
(54, 'ABS Antistatic', 0.09, 'Antistatic ABS for electronics', 6000.00),
(55, 'ABS Heat Resistant', 0.08, 'High temperature ABS', 6500.00),
(56, 'ABS Industrial Grade', 0.07, 'Durable ABS for industrial parts', 9000.00),
(57, 'ABS Recycled', 0.04, 'Recycled ABS material', 18000.00),
(58, 'ABS Flame Retardant Plus', 0.11, 'High grade flame retardant ABS', 4000.00),
(59, 'ABS Impact Extreme', 0.09, 'Impact resistant ABS', 6000.00),
(60, 'ABS Lightweight', 0.06, 'Lightweight foaming ABS', 7500.00),
(61, 'Nylon PA6', 0.13, 'Standard PA6 nylon', 7000.00),
(62, 'Nylon PA12', 0.10, 'Durable nylon PA12', 7500.00),
(63, 'Nylon Carbon Fiber', 0.22, 'Carbon reinforced nylon', 4500.00),
(64, 'Nylon Glass Fiber', 0.20, 'Glass reinforced nylon', 4500.00),
(65, 'Nylon Lubricated', 0.15, 'Self lubricating nylon', 4000.00),
(66, 'Nylon Flame Retardant', 0.18, 'Fire resistant nylon', 3500.00),
(67, 'Nylon Industrial', 0.14, 'Industrial strength nylon', 6000.00),
(68, 'Nylon Recycled', 0.05, 'Recycled nylon', 14000.00),
(69, 'Nylon High Temp', 0.19, 'High temperature nylon', 3000.00),
(70, 'Nylon Structural', 0.21, 'Structural nylon composite', 3500.00),
(71, 'TPU 85A', 0.11, 'Very flexible TPU', 6000.00),
(72, 'TPU 95A', 0.09, 'Standard flexible TPU', 7000.00),
(73, 'TPU 98A', 0.12, 'Semi rigid TPU', 5000.00),
(74, 'TPU Carbon Fiber', 0.18, 'Reinforced flexible TPU', 4000.00),
(75, 'TPU Chemical Resistant', 0.14, 'Chemical resistant TPU', 3500.00),
(76, 'TPU UV Resistant', 0.13, 'UV stable TPU', 4000.00),
(77, 'TPU Industrial Flex', 0.12, 'Industrial flexible polymer', 4500.00),
(78, 'TPU Recycled', 0.06, 'Recycled TPU material', 9000.00),
(79, 'TPE Rubber Blend', 0.10, 'Rubber like flexible filament', 7000.00),
(80, 'TPE Soft Touch', 0.11, 'Soft flexible rubber polymer', 6000.00),
(81, 'Polycarbonate', 0.22, 'Strong transparent polycarbonate', 5000.00),
(82, 'Polycarbonate Carbon Fiber', 0.35, 'Carbon reinforced PC', 3000.00),
(83, 'Polycarbonate Glass Fiber', 0.30, 'Glass reinforced PC', 3200.00),
(84, 'Polycarbonate Flame Retardant', 0.28, 'Fire resistant PC', 3000.00),
(85, 'Polycarbonate UV Resistant', 0.24, 'UV resistant PC', 3500.00),
(86, 'Polycarbonate Industrial', 0.26, 'Industrial grade PC', 4000.00),
(87, 'Polycarbonate Transparent', 0.23, 'High clarity PC', 4500.00),
(88, 'Polycarbonate Structural', 0.27, 'Structural polycarbonate', 3000.00),
(89, 'Polycarbonate High Temp', 0.29, 'Heat resistant PC', 2500.00),
(90, 'Polycarbonate Recycled', 0.10, 'Recycled polycarbonate', 9000.00),
(91, 'PEEK Standard', 0.80, 'High performance PEEK polymer', 1500.00),
(92, 'PEEK Carbon Fiber', 1.20, 'Carbon reinforced PEEK', 1200.00),
(93, 'PEEK Glass Fiber', 1.10, 'Glass reinforced PEEK', 1200.00),
(94, 'PEEK Industrial', 0.95, 'Industrial grade PEEK', 1300.00),
(95, 'PEEK Medical', 1.30, 'Medical grade PEEK polymer', 800.00),
(96, 'PEI ULTEM 9085', 0.70, 'High temperature PEI', 2000.00),
(97, 'PEI Flame Retardant', 0.75, 'Fire resistant PEI', 1800.00),
(98, 'PEI Industrial', 0.72, 'Industrial PEI plastic', 1900.00),
(99, 'PEI Carbon Fiber', 0.85, 'Carbon reinforced PEI', 1600.00),
(100, 'PEI High Temp', 0.78, 'Heat resistant PEI polymer', 1700.00),
(101, 'Steel Powder 316L', 2.00, 'Stainless steel powder for DMLS', 1500.00),
(102, 'Steel Powder 17-4PH', 2.20, 'High strength steel powder', 1200.00),
(103, 'Tool Steel H13', 2.40, 'Tool steel powder', 1000.00),
(104, 'Maraging Steel', 2.50, 'High performance maraging steel', 900.00),
(105, 'Stainless Steel 304', 1.90, 'Corrosion resistant steel', 1600.00),
(106, 'Aluminium AlSi10Mg', 1.50, 'Aluminium powder for metal printing', 2000.00),
(107, 'Aluminium Scalmalloy', 1.70, 'High strength aluminium alloy', 1800.00),
(108, 'Aluminium Lightweight', 1.45, 'Lightweight aluminium metal powder', 2200.00),
(109, 'Titanium Ti6Al4V', 3.50, 'Titanium alloy for structural parts', 1000.00),
(110, 'Titanium Grade 2', 3.20, 'Pure titanium powder', 1100.00),
(111, 'Titanium High Strength', 3.80, 'High strength titanium alloy', 900.00),
(112, 'Copper Powder', 2.80, 'Copper powder for conductive parts', 1200.00),
(113, 'Bronze Powder', 2.40, 'Bronze metal powder', 1300.00),
(114, 'Brass Powder', 2.20, 'Brass powder metal printing', 1400.00),
(115, 'Nickel Alloy Inconel 718', 4.00, 'High temperature nickel alloy', 800.00),
(116, 'Inconel 625', 4.20, 'Extreme heat resistant alloy', 700.00),
(117, 'Concrete 3D Mix Standard', 0.02, 'Concrete mix for building printing', 50000.00),
(118, 'Concrete Fiber Reinforced', 0.04, 'Fiber reinforced concrete', 30000.00),
(119, 'Geopolymer Concrete', 0.03, 'Eco friendly concrete', 40000.00),
(120, 'Ultra High Performance Concrete', 0.06, 'UHPC construction mix', 20000.00),
(121, 'Basalt Fiber Concrete', 0.05, 'Basalt reinforced concrete', 22000.00),
(122, 'Ceramic Clay Print', 0.03, 'Clay ceramic printable material', 25000.00),
(123, 'Gypsum Powder', 0.02, 'Gypsum architectural printing powder', 26000.00),
(124, 'Sandstone Powder', 0.04, 'Sandstone architectural models', 18000.00),
(125, 'Graphene PLA', 0.30, 'Graphene enhanced PLA', 2000.00),
(126, 'Graphene PETG', 0.32, 'Graphene reinforced PETG', 2000.00),
(127, 'Conductive Carbon PLA', 0.20, 'Electrically conductive PLA', 2500.00),
(128, 'Magnetic Iron PLA', 0.18, 'Magnetic iron filled PLA', 3000.00),
(129, 'Wood PLA Oak', 0.09, 'Oak wood composite PLA', 5000.00),
(130, 'Wood PLA Pine', 0.08, 'Pine wood composite PLA', 5500.00),
(131, 'Wood PLA Walnut', 0.09, 'Walnut composite PLA', 4500.00),
(132, 'Wood PLA Birch', 0.08, 'Birch wood PLA', 5000.00),
(133, 'Stone PLA Granite', 0.10, 'Granite stone composite PLA', 4000.00),
(134, 'Stone PLA Limestone', 0.09, 'Limestone composite PLA', 4500.00),
(135, 'Recycled PLA', 0.03, 'Fully recycled PLA', 20000.00),
(136, 'Recycled PET', 0.04, 'Recycled PET plastic', 17000.00),
(137, 'Recycled ABS Eco', 0.04, 'Eco recycled ABS', 20000.00),
(138, 'Carbon Fiber PLA Pro', 0.25, 'Professional carbon fiber PLA', 3500.00),
(139, 'Carbon Fiber PETG Pro', 0.28, 'Professional carbon fiber PETG', 3000.00),
(140, 'Carbon Fiber Nylon Pro', 0.32, 'Professional carbon nylon', 2500.00),
(141, 'Glass Fiber PLA Pro', 0.20, 'High strength glass PLA', 3000.00),
(142, 'Glass Fiber PETG Pro', 0.22, 'Glass PETG composite', 2800.00),
(143, 'Glass Fiber Nylon Pro', 0.30, 'Glass reinforced nylon', 2600.00),
(144, 'Carbon Fiber ABS Pro', 0.26, 'Professional carbon reinforced ABS', 3000.00),
(145, 'Carbon Fiber PC Pro', 0.40, 'Carbon fiber reinforced polycarbonate', 2500.00),
(146, 'Carbon Fiber PEEK', 1.40, 'Ultra high strength carbon fiber PEEK', 900.00),
(147, 'Glass Fiber ABS', 0.19, 'Glass reinforced ABS', 4200.00),
(148, 'Glass Fiber PC', 0.31, 'Glass reinforced polycarbonate', 3200.00),
(149, 'Glass Fiber PEEK', 1.25, 'Glass reinforced PEEK', 800.00),
(150, 'Basalt Fiber PLA', 0.17, 'Basalt reinforced PLA composite', 3500.00),
(151, 'Basalt Fiber PETG', 0.19, 'Basalt reinforced PETG composite', 3200.00),
(152, 'Basalt Fiber Nylon', 0.28, 'Basalt reinforced nylon', 2800.00),
(153, 'PLA Structural Pro', 0.13, 'High strength PLA for structural prototypes', 5000.00),
(154, 'PLA High Temp Pro', 0.07, 'High temperature resistant PLA', 7000.00),
(155, 'PLA UV Outdoor', 0.06, 'Outdoor UV resistant PLA', 9000.00),
(156, 'PLA Lightweight Foam', 0.05, 'Foaming lightweight PLA', 10000.00),
(157, 'PLA Impact Industrial', 0.08, 'Industrial impact resistant PLA', 6500.00),
(158, 'PETG Structural', 0.09, 'Strong PETG for structural components', 6000.00),
(159, 'PETG High Temp', 0.10, 'Heat resistant PETG', 5000.00),
(160, 'PETG Industrial Tough', 0.09, 'High durability PETG', 6500.00),
(161, 'PETG Outdoor Pro', 0.08, 'Outdoor resistant PETG', 7500.00),
(162, 'PETG Transparent Pro', 0.09, 'High clarity PETG', 6000.00),
(163, 'ABS Structural', 0.09, 'Structural ABS plastic', 6500.00),
(164, 'ABS Outdoor UV', 0.08, 'UV resistant ABS', 7000.00),
(165, 'ABS Industrial Tough', 0.09, 'Impact resistant ABS', 6000.00),
(166, 'ABS High Temp Pro', 0.10, 'Heat resistant ABS', 5000.00),
(167, 'ABS Electrical Safe', 0.09, 'ABS safe for electronic housings', 5500.00),
(168, 'Nylon Structural Pro', 0.22, 'Structural nylon composite', 3000.00),
(169, 'Nylon High Wear', 0.18, 'Wear resistant nylon', 3500.00),
(170, 'Nylon Impact Pro', 0.20, 'Impact resistant nylon', 3200.00),
(171, 'Nylon Outdoor Grade', 0.19, 'Outdoor resistant nylon', 3300.00),
(172, 'Nylon Mechanical', 0.21, 'Mechanical grade nylon', 3000.00),
(173, 'TPU Soft Industrial', 0.12, 'Soft industrial TPU', 5000.00),
(174, 'TPU High Grip', 0.13, 'High friction TPU material', 4500.00),
(175, 'TPU Structural Flex', 0.14, 'Flexible structural polymer', 4200.00),
(176, 'TPU Outdoor Flex', 0.13, 'UV resistant TPU', 4600.00),
(177, 'TPU Heavy Duty', 0.15, 'Heavy duty flexible polymer', 3800.00),
(178, 'Polycarbonate Structural', 0.28, 'Structural polycarbonate plastic', 3500.00),
(179, 'Polycarbonate Outdoor', 0.26, 'Outdoor resistant polycarbonate', 3700.00),
(180, 'Polycarbonate Impact Pro', 0.30, 'Impact resistant PC', 3000.00),
(181, 'Polycarbonate Clear Pro', 0.27, 'High clarity PC material', 3600.00),
(182, 'Polycarbonate Industrial Tough', 0.29, 'Industrial polycarbonate', 3300.00),
(183, 'PEEK Structural', 0.95, 'Structural high performance PEEK', 1200.00),
(184, 'PEEK Industrial Tough', 1.05, 'Industrial PEEK polymer', 1000.00),
(185, 'PEEK Wear Resistant', 1.10, 'Wear resistant PEEK', 900.00),
(186, 'PEI Structural', 0.80, 'Structural PEI material', 1500.00),
(187, 'PEI Heat Shield', 0.85, 'High heat resistant PEI', 1400.00),
(188, 'PEI Industrial Tough', 0.83, 'Industrial grade PEI', 1450.00),
(189, 'Steel Tool Powder M2', 2.50, 'Tool steel powder for industrial parts', 900.00),
(190, 'Steel Tool Powder D2', 2.40, 'D2 tool steel powder', 950.00),
(191, 'Steel Structural Alloy', 2.30, 'High strength structural steel powder', 1000.00),
(192, 'Aluminium Structural Alloy', 1.60, 'Structural aluminium alloy', 1800.00),
(193, 'Aluminium Lightweight Alloy', 1.55, 'Lightweight aluminium printing powder', 1900.00),
(194, 'Aluminium High Strength', 1.65, 'High strength aluminium powder', 1700.00),
(195, 'Titanium Structural Alloy', 3.70, 'Structural titanium alloy', 900.00),
(196, 'Titanium Aerospace Grade', 4.10, 'Aerospace titanium alloy', 800.00),
(197, 'Copper Conductive Pro', 2.90, 'Highly conductive copper powder', 1000.00),
(198, 'Bronze Structural Powder', 2.50, 'Structural bronze powder', 1100.00),
(199, 'Concrete Print Mix Eco', 0.03, 'Eco friendly printable concrete', 42000.00),
(200, 'Concrete Structural Mix', 0.05, 'Structural concrete printing mix', 25000.00),
(201, 'Concrete Rapid Cure', 0.06, 'Fast curing concrete print mix', 20000.00),
(202, 'Ceramic Structural Clay', 0.04, 'Structural clay ceramic mix', 20000.00),
(203, 'Ceramic Architectural Mix', 0.05, 'Ceramic mix for architectural printing', 18000.00),
(204, 'Graphene Reinforced PLA', 0.32, 'Graphene reinforced PLA', 1800.00),
(205, 'Graphene Reinforced PETG', 0.34, 'Graphene reinforced PETG', 1700.00),
(206, 'Magnetic Iron PETG', 0.20, 'Magnetic PETG composite', 2500.00),
(207, 'Magnetic Iron ABS', 0.21, 'Magnetic ABS composite', 2300.00),
(208, 'Wood PLA Mahogany', 0.09, 'Mahogany wood PLA composite', 4000.00),
(209, 'Wood PLA Cedar', 0.08, 'Cedar wood PLA composite', 4200.00),
(210, 'Stone PLA Slate', 0.10, 'Slate stone composite PLA', 3800.00),
(211, 'Stone PLA Sandstone', 0.10, 'Sandstone composite PLA', 3700.00),
(212, 'Recycled PLA Industrial', 0.04, 'Industrial recycled PLA', 18000.00),
(213, 'Recycled PETG Industrial', 0.05, 'Industrial recycled PETG', 16000.00),
(214, 'Recycled ABS Industrial', 0.05, 'Industrial recycled ABS', 17000.00),
(215, 'Carbon Nylon Extreme', 0.35, 'Extreme strength carbon nylon', 2200.00),
(216, 'Carbon PETG Extreme', 0.30, 'Extreme strength PETG composite', 2400.00),
(217, 'Glass Nylon Extreme', 0.33, 'Extreme glass reinforced nylon', 2100.00),
(218, 'Glass PLA Extreme', 0.24, 'Extreme glass reinforced PLA', 2600.00),
(219, 'Basalt Nylon Extreme', 0.34, 'Extreme basalt reinforced nylon', 2000.00),
(220, 'Basalt PETG Extreme', 0.27, 'Extreme basalt PETG composite', 2300.00),
(221, 'Insulation Foam PLA', 0.06, 'Insulating foamed PLA', 9000.00),
(222, 'Insulation Foam PETG', 0.07, 'Insulating PETG composite', 8000.00),
(223, 'Construction Polymer Blend', 0.12, 'Polymer blend for construction parts', 5000.00),
(224, 'Construction Structural Polymer', 0.14, 'Structural polymer for construction printing', 4500.00),
(225, 'Architectural Model PLA', 0.05, 'PLA for architectural scale models', 12000.00),
(226, 'Architectural Model PETG', 0.06, 'PETG for architectural models', 11000.00),
(227, 'Industrial Prototype PLA', 0.07, 'PLA for industrial prototyping', 9000.00),
(228, 'Industrial Prototype ABS', 0.08, 'ABS for industrial prototyping', 8500.00),
(229, 'High Density PLA', 0.08, 'High density PLA composite', 7000.00),
(230, 'High Density PETG', 0.09, 'High density PETG composite', 6500.00),
(231, 'Smart Sensor PLA', 0.20, 'PLA compatible with embedded sensors', 2500.00),
(232, 'Smart Sensor PETG', 0.21, 'PETG compatible with embedded sensors', 2400.00),
(233, 'Thermal Resistant PLA', 0.09, 'Thermal resistant PLA', 6000.00),
(234, 'Thermal Resistant PETG', 0.10, 'Thermal resistant PETG', 5500.00),
(235, 'Structural Carbon PLA', 0.28, 'Structural carbon fiber PLA', 3000.00),
(236, 'Structural Carbon PETG', 0.29, 'Structural carbon PETG', 2800.00),
(237, 'Structural Glass PLA', 0.23, 'Structural glass PLA composite', 3200.00),
(238, 'Structural Glass PETG', 0.25, 'Structural glass PETG composite', 3000.00),
(239, 'Construction Reinforced Polymer', 0.18, 'Reinforced construction polymer', 4000.00),
(240, 'Construction Composite Polymer', 0.20, 'Composite construction polymer', 3500.00),
(241, 'Advanced Engineering PLA', 0.10, 'Engineering grade PLA', 5000.00),
(242, 'Advanced Engineering PETG', 0.11, 'Engineering grade PETG', 4800.00),
(243, 'Advanced Engineering ABS', 0.12, 'Engineering grade ABS', 4600.00),
(244, 'Industrial Carbon PC', 0.42, 'Carbon reinforced industrial PC', 2400.00),
(245, 'Industrial Glass PC', 0.35, 'Glass reinforced industrial PC', 2600.00),
(246, 'High Strength Nylon Pro', 0.24, 'High strength nylon', 2700.00),
(247, 'High Strength PETG Pro', 0.13, 'High strength PETG', 5200.00),
(248, 'High Strength PLA Pro', 0.12, 'High strength PLA', 5400.00),
(249, 'Ultra Tough ABS', 0.11, 'Ultra tough ABS', 5000.00),
(250, 'Ultra Tough PETG', 0.12, 'Ultra tough PETG', 5200.00),
(251, 'Ultra Tough Nylon', 0.25, 'Ultra tough nylon', 2600.00),
(252, 'Smart Composite PLA', 0.18, 'Advanced composite PLA', 3500.00),
(253, 'Smart Composite PETG', 0.19, 'Advanced composite PETG', 3300.00),
(254, 'Smart Composite Nylon', 0.28, 'Advanced composite nylon', 3000.00),
(255, 'Eco Structural PLA', 0.06, 'Eco structural PLA', 8000.00),
(256, 'Eco Structural PETG', 0.07, 'Eco structural PETG', 7800.00),
(257, 'Eco Structural ABS', 0.08, 'Eco structural ABS', 7500.00),
(258, 'Eco Structural Nylon', 0.12, 'Eco structural nylon', 6000.00),
(259, 'Eco Construction Polymer', 0.09, 'Eco construction polymer', 7000.00),
(260, 'Eco Concrete Composite', 0.03, 'Eco concrete composite', 35000.00),
(261, 'Hybrid Carbon PLA', 0.27, 'Hybrid carbon PLA composite', 3100.00),
(262, 'Hybrid Carbon PETG', 0.28, 'Hybrid carbon PETG composite', 3000.00),
(263, 'Hybrid Glass PLA', 0.22, 'Hybrid glass PLA composite', 3200.00),
(264, 'Hybrid Glass PETG', 0.24, 'Hybrid glass PETG composite', 3100.00),
(265, 'Hybrid Nylon Composite', 0.30, 'Hybrid nylon composite', 2800.00),
(266, 'Industrial Print PLA', 0.08, 'Industrial printing PLA', 9000.00),
(267, 'Industrial Print PETG', 0.09, 'Industrial printing PETG', 8500.00),
(268, 'Industrial Print ABS', 0.10, 'Industrial printing ABS', 8000.00),
(269, 'Industrial Print Nylon', 0.14, 'Industrial printing nylon', 6500.00),
(270, 'Industrial Print TPU', 0.13, 'Industrial printing TPU', 6000.00),
(271, 'Precision Model PLA', 0.06, 'Precision modeling PLA', 10000.00),
(272, 'Precision Model PETG', 0.07, 'Precision modeling PETG', 9500.00),
(273, 'Precision Model ABS', 0.08, 'Precision modeling ABS', 9000.00),
(274, 'Precision Model Nylon', 0.12, 'Precision modeling nylon', 7000.00),
(275, 'Precision Model TPU', 0.11, 'Precision modeling TPU', 7200.00),
(276, 'Advanced Structural PLA', 0.13, 'Advanced structural PLA', 5000.00),
(277, 'Advanced Structural PETG', 0.14, 'Advanced structural PETG', 4800.00),
(278, 'Advanced Structural ABS', 0.15, 'Advanced structural ABS', 4600.00),
(279, 'Advanced Structural Nylon', 0.22, 'Advanced structural nylon', 3500.00),
(280, 'Advanced Structural TPU', 0.16, 'Advanced structural TPU', 4000.00),
(281, 'Nano Reinforced PLA', 0.30, 'Nano reinforced PLA', 2000.00),
(282, 'Nano Reinforced PETG', 0.31, 'Nano reinforced PETG', 2000.00),
(283, 'Nano Reinforced Nylon', 0.35, 'Nano reinforced nylon', 1800.00),
(284, 'Nano Reinforced PC', 0.38, 'Nano reinforced polycarbonate', 1700.00),
(285, 'Nano Reinforced PEEK', 1.50, 'Nano reinforced PEEK', 600.00),
(286, 'Smart Building Polymer', 0.18, 'Polymer for smart building components', 4500.00),
(287, 'Smart Building Composite', 0.20, 'Composite for smart building systems', 4200.00),
(288, 'Thermal Insulation Polymer', 0.12, 'Thermal insulation polymer', 6000.00),
(289, 'Thermal Insulation Composite', 0.14, 'Thermal insulation composite', 5500.00),
(290, 'Acoustic Insulation PLA', 0.09, 'Acoustic insulation PLA', 7000.00),
(291, 'Acoustic Insulation PETG', 0.10, 'Acoustic insulation PETG', 6500.00),
(292, 'Acoustic Insulation Polymer', 0.11, 'Acoustic insulation polymer', 6200.00),
(293, 'Structural Hybrid Polymer', 0.18, 'Hybrid structural polymer', 5000.00),
(294, 'Structural Hybrid Composite', 0.20, 'Hybrid structural composite', 4500.00),
(295, 'Advanced Construction Polymer', 0.22, 'Advanced polymer for construction printing', 4200.00),
(296, 'Advanced Construction Composite', 0.24, 'Advanced composite for construction', 4000.00),
(297, 'Future Composite PLA', 0.26, 'Experimental composite PLA', 3000.00),
(298, 'Future Composite PETG', 0.27, 'Experimental composite PETG', 2900.00),
(299, 'Future Composite Nylon', 0.32, 'Experimental composite nylon', 2600.00),
(300, 'Future Composite Polymer', 0.28, 'Experimental construction polymer', 2800.00);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status_code` varchar(20) NOT NULL,
  `delivery_method` enum('pickup','standard','express') DEFAULT NULL,
  `delivery_address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `status_code`, `delivery_method`, `delivery_address`, `created_at`, `updated_at`) VALUES
(1, 5, 'PENDING', 'standard', 'Burgemeester van Sonsbeeklaan 10, 4815TA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(2, 12, 'PROCESSING', 'express', 'Clarastraat 25, 4817JX Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(3, 25, 'SHIPPED', 'standard', 'Haagseweg 112, 4834GA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(4, 37, 'DELIVERED', 'pickup', 'Ettenseweg 50, 4824AB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(5, 45, 'PENDING', 'express', 'Wilhelminasingel 301, 4818AA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(6, 52, 'CANCELLED', 'standard', 'Baronielaan 15, 4813HA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(7, 68, 'PROCESSING', 'pickup', 'Kloosterstraat 42, 4811XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(8, 73, 'SHIPPED', 'express', 'Prinsenkade 88, 4811VB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(9, 81, 'DELIVERED', 'standard', 'Speelhuislaan 7, 4815EV Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(10, 94, 'PENDING', 'pickup', 'Teteringsedijk 120, 4817ML Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(11, 102, 'IN_TRANSIT', 'standard', 'Zandberglaan 200, 4835GJ Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(12, 15, 'PENDING', 'express', 'Bavelseweg 101, 4819AA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(13, 22, 'PROCESSING', 'standard', 'Hoge Mosten 55, 4812XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(14, 33, 'SHIPPED', 'pickup', 'Liniestraat 33, 4816JB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(15, 48, 'DELIVERED', 'express', 'Baronieplein 12, 4813HA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(16, 55, 'PENDING', 'standard', 'Kasteelplein 15, 4811XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(17, 62, 'CANCELLED', 'pickup', 'Wilhelminapark 8, 4817JX Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(18, 79, 'PROCESSING', 'express', 'Ginnekenweg 200, 4835GA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(19, 87, 'SHIPPED', 'standard', 'Burgemeester de Koklaan 1, 4815TA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(20, 99, 'DELIVERED', 'pickup', 'Clarastraat 100, 4817JX Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(21, 94, 'PENDING', 'express', 'Haagseweg 202, 4834GA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(22, 75, 'PROCESSING', 'standard', 'Ettenseweg 150, 4824AB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(23, 105, 'SHIPPED', 'pickup', 'Wilhelminasingel 400, 4818AA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(24, 92, 'DELIVERED', 'express', 'Baronielaan 200, 4813HA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(25, 101, 'PENDING', 'standard', 'Kloosterstraat 150, 4811XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(26, 8, 'IN_TRANSIT', 'pickup', 'Prinsenkade 150, 4811VB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(27, 19, 'PENDING', 'express', 'Speelhuislaan 50, 4815EV Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(28, 30, 'PROCESSING', 'standard', 'Teteringsedijk 200, 4817ML Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(29, 41, 'SHIPPED', 'pickup', 'Zandberglaan 300, 4835GJ Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(30, 50, 'DELIVERED', 'express', 'Bavelseweg 200, 4819AA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(31, 60, 'PENDING', 'standard', 'Hoge Mosten 150, 4812XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(32, 70, 'CANCELLED', 'pickup', 'Liniestraat 100, 4816JB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(33, 80, 'PROCESSING', 'express', 'Baronieplein 50, 4813HA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(34, 90, 'SHIPPED', 'standard', 'Kasteelplein 50, 4811XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(35, 100, 'DELIVERED', 'pickup', 'Wilhelminapark 20, 4817JX Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(36, 11, 'PENDING', 'express', 'Ginnekenweg 300, 4835GA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(37, 23, 'PROCESSING', 'standard', 'Burgemeester de Koklaan 50, 4815TA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(38, 35, 'SHIPPED', 'pickup', 'Clarastraat 200, 4817JX Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(39, 47, 'DELIVERED', 'express', 'Haagseweg 300, 4834GA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(40, 58, 'PENDING', 'standard', 'Ettenseweg 250, 4824AB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(41, 67, 'CANCELLED', 'pickup', 'Wilhelminasingel 500, 4818AA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(42, 76, 'PROCESSING', 'express', 'Baronielaan 250, 4813HA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(43, 85, 'SHIPPED', 'standard', 'Kloosterstraat 200, 4811XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(44, 93, 'DELIVERED', 'pickup', 'Prinsenkade 200, 4811VB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(45, 105, 'PENDING', 'express', 'Speelhuislaan 100, 4815EV Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(46, 103, 'PROCESSING', 'standard', 'Teteringsedijk 300, 4817ML Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(47, 49, 'SHIPPED', 'pickup', 'Zandberglaan 400, 4835GJ Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(48, 32, 'DELIVERED', 'express', 'Bavelseweg 300, 4819AA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(49, 82, 'PENDING', 'standard', 'Hoge Mosten 200, 4812XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(50, 67, 'CANCELLED', 'pickup', 'Liniestraat 200, 4816JB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(51, 4, 'IN_TRANSIT', 'express', 'Baronieplein 100, 4813HA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(52, 14, 'PENDING', 'standard', 'Kasteelplein 100, 4811XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(53, 24, 'PROCESSING', 'pickup', 'Wilhelminapark 50, 4817JX Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(54, 34, 'SHIPPED', 'express', 'Ginnekenweg 400, 4835GA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(55, 44, 'DELIVERED', 'standard', 'Burgemeester de Koklaan 100, 4815TA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(56, 54, 'PENDING', 'pickup', 'Clarastraat 300, 4817JX Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(57, 64, 'CANCELLED', 'express', 'Haagseweg 400, 4834GA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(58, 74, 'PROCESSING', 'standard', 'Ettenseweg 300, 4824AB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(59, 84, 'SHIPPED', 'pickup', 'Wilhelminasingel 600, 4818AA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(60, 96, 'DELIVERED', 'express', 'Baronielaan 300, 4813HA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(61, 106, 'PENDING', 'standard', 'Kloosterstraat 300, 4811XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(62, 54, 'IN_TRANSIT', 'pickup', 'Prinsenkade 300, 4811VB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(63, 68, 'PENDING', 'express', 'Speelhuislaan 150, 4815EV Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(64, 36, 'PROCESSING', 'standard', 'Teteringsedijk 400, 4817ML Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(65, 102, 'SHIPPED', 'pickup', 'Zandberglaan 500, 4835GJ Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(66, 3, 'DELIVERED', 'express', 'Bavelseweg 400, 4819AA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(67, 13, 'PENDING', 'standard', 'Hoge Mosten 300, 4812XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(68, 23, 'CANCELLED', 'pickup', 'Liniestraat 300, 4816JB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(69, 33, 'PROCESSING', 'express', 'Baronieplein 150, 4813HA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(70, 43, 'SHIPPED', 'standard', 'Kasteelplein 150, 4811XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(71, 53, 'DELIVERED', 'pickup', 'Wilhelminapark 100, 4817JX Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(72, 63, 'PENDING', 'express', 'Ginnekenweg 500, 4835GA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(73, 72, 'IN_TRANSIT', 'standard', 'Burgemeester de Koklaan 150, 4815TA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(74, 82, 'PENDING', 'pickup', 'Clarastraat 400, 4817JX Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(75, 92, 'PROCESSING', 'express', 'Haagseweg 500, 4834GA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(76, 103, 'SHIPPED', 'standard', 'Ettenseweg 400, 4824AB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(77, 119, 'DELIVERED', 'pickup', 'Wilhelminasingel 700, 4818AA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(78, 121, 'PENDING', 'express', 'Baronielaan 400, 4813HA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(79, 118, 'CANCELLED', 'standard', 'Kloosterstraat 400, 4811XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(80, 56, 'PROCESSING', 'pickup', 'Prinsenkade 400, 4811VB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(81, 2, 'SHIPPED', 'express', 'Speelhuislaan 200, 4815EV Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(82, 12, 'DELIVERED', 'standard', 'Teteringsedijk 500, 4817ML Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(83, 22, 'PENDING', 'pickup', 'Zandberglaan 600, 4835GJ Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(84, 32, 'IN_TRANSIT', 'express', 'Bavelseweg 500, 4819AA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(85, 42, 'PENDING', 'standard', 'Hoge Mosten 400, 4812XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(86, 51, 'PROCESSING', 'pickup', 'Liniestraat 400, 4816JB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(87, 61, 'SHIPPED', 'express', 'Baronieplein 200, 4813HA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(88, 71, 'DELIVERED', 'standard', 'Kasteelplein 200, 4811XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(89, 81, 'PENDING', 'pickup', 'Wilhelminapark 150, 4817JX Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(90, 91, 'PROCESSING', 'express', 'Ginnekenweg 600, 4835GA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(91, 101, 'SHIPPED', 'standard', 'Burgemeester de Koklaan 200, 4815TA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(92, 111, 'DELIVERED', 'pickup', 'Clarastraat 500, 4817JX Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(93, 121, 'PENDING', 'express', 'Haagseweg 600, 4834GA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(94, 29, 'CANCELLED', 'standard', 'Ettenseweg 500, 4824AB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(95, 117, 'PROCESSING', 'pickup', 'Wilhelminasingel 800, 4818AA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(96, 6, 'SHIPPED', 'express', 'Baronielaan 500, 4813HA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(97, 16, 'DELIVERED', 'standard', 'Kloosterstraat 500, 4811XA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(98, 26, 'PENDING', 'pickup', 'Prinsenkade 500, 4811VB Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(99, 36, 'IN_TRANSIT', 'express', 'Speelhuislaan 300, 4815EV Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(100, 46, 'PENDING', 'standard', 'Teteringsedijk 600, 4817ML Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(101, 5, 'PENDING', 'standard', 'Burgemeester van Sonsbeeklaan 10, 4815TA Breda', '2026-03-27 07:49:55', '2026-03-27 07:49:55');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_line_items`
--

CREATE TABLE `order_line_items` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` smallint(5) UNSIGNED NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ;

--
-- Gegevens worden geëxporteerd voor tabel `order_line_items`
--

INSERT INTO `order_line_items` (`order_id`, `product_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 150.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(1, 3, 2, 45.75, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(2, 2, 3, 250.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(2, 7, 1, 1200.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(3, 5, 4, 85.25, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(3, 9, 10, 3.75, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(4, 4, 2, 4999.99, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(4, 10, 5, 18.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(5, 6, 3, 300.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(5, 8, 1, 75.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(6, 1, 2, 1250.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(6, 2, 1, 9.99, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(7, 3, 4, 65.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(7, 5, 2, 225.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(8, 4, 5, 1500.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(8, 7, 3, 350.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(9, 6, 1, 180.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(9, 9, 8, 45.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(10, 8, 2, 850.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(10, 10, 12, 37.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(11, 1, 3, 125.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(11, 5, 1, 225.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(12, 2, 4, 87.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(12, 9, 6, 45.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(13, 3, 2, 62.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(13, 10, 10, 37.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(14, 4, 3, 150.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(14, 6, 2, 180.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(15, 5, 5, 225.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(15, 7, 1, 350.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(16, 1, 4, 125.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(16, 8, 2, 850.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(17, 2, 2, 87.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(17, 9, 5, 45.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(18, 3, 3, 62.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(18, 10, 8, 37.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(19, 4, 2, 150.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(19, 6, 3, 180.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(20, 5, 1, 225.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(20, 7, 2, 350.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(21, 1, 5, 125.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(21, 9, 10, 45.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(22, 2, 3, 87.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(22, 8, 1, 850.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(23, 3, 4, 62.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(23, 10, 12, 37.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(24, 4, 2, 150.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(24, 6, 1, 180.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(25, 5, 3, 225.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(25, 7, 2, 350.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(26, 1, 4, 125.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(26, 9, 8, 45.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(27, 2, 2, 87.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(27, 10, 10, 37.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(28, 3, 3, 62.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(28, 8, 1, 850.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(29, 4, 5, 1500.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(29, 6, 1, 180.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(30, 5, 1, 225.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(30, 7, 3, 350.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(31, 1, 2, 125.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(31, 9, 6, 45.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(32, 2, 4, 87.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(32, 10, 8, 37.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(33, 3, 2, 62.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(33, 5, 3, 225.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(34, 4, 4, 150.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(34, 6, 1, 180.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(35, 5, 2, 225.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(35, 7, 1, 350.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(36, 1, 3, 125.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(36, 8, 2, 850.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(37, 2, 2, 87.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(37, 9, 5, 45.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(38, 3, 4, 62.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(38, 10, 10, 37.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(39, 4, 3, 150.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(39, 6, 2, 180.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(40, 5, 1, 225.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(40, 7, 3, 350.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(41, 1, 5, 125.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(41, 9, 8, 45.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(42, 2, 3, 87.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(42, 8, 1, 850.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(43, 3, 2, 62.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(43, 10, 12, 37.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(44, 4, 4, 150.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(44, 6, 1, 180.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(45, 5, 3, 225.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(45, 7, 2, 350.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(46, 1, 4, 125.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(46, 9, 6, 45.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(47, 2, 2, 87.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(47, 10, 10, 37.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(48, 3, 3, 62.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(48, 8, 2, 850.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(49, 4, 5, 1500.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(49, 6, 1, 180.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(50, 5, 2, 225.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(50, 7, 1, 350.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(51, 11, 1, 125.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(52, 12, 2, 499.99, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(53, 13, 1, 75.25, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(54, 14, 3, 1200.75, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(55, 15, 1, 34.99, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(56, 16, 2, 850.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(57, 17, 1, 19.95, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(58, 18, 4, 4999.99, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(59, 19, 1, 250.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(60, 20, 2, 1500.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(61, 11, 1, 300.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(62, 12, 3, 750.25, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(63, 13, 1, 45.75, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(64, 14, 2, 2000.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(65, 15, 1, 12.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(66, 16, 4, 3500.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(67, 17, 1, 89.99, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(68, 18, 3, 1750.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(69, 19, 1, 300.75, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(70, 20, 2, 950.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(71, 11, 1, 225.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(72, 12, 5, 4500.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(73, 13, 1, 65.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(74, 14, 2, 1100.25, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(75, 15, 1, 29.99, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(76, 16, 3, 2750.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(77, 17, 1, 15.99, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(78, 18, 4, 4800.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(79, 19, 1, 400.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(80, 20, 2, 1300.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(81, 11, 1, 175.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(82, 12, 3, 950.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(83, 13, 1, 55.25, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(84, 14, 2, 1800.75, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(85, 15, 1, 22.99, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(86, 16, 4, 3200.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(87, 17, 1, 79.99, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(88, 18, 3, 1600.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(89, 19, 1, 275.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(90, 20, 2, 1150.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(91, 11, 1, 375.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(92, 12, 5, 4750.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(93, 13, 1, 50.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(94, 14, 2, 1300.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(95, 15, 1, 18.99, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(96, 16, 3, 2900.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(97, 17, 1, 12.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(98, 18, 4, 4950.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(99, 19, 1, 325.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(100, 20, 2, 1400.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(101, 1, 5, 150.00, '2026-04-03 13:11:10', '2026-04-03 13:11:10');

--
-- Triggers `order_line_items`
--
DELIMITER $$
CREATE TRIGGER `trg_after_orderline_insert` AFTER INSERT ON `order_line_items` FOR EACH ROW BEGIN
    -- Reduce stock when a new order line is inserted
    UPDATE catalog_products
    SET stock_quantity = stock_quantity - NEW.quantity
    WHERE product_id = NEW.product_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `order_statuses`
--

CREATE TABLE `order_statuses` (
  `status_code` varchar(20) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `order_statuses`
--

INSERT INTO `order_statuses` (`status_code`, `label`) VALUES
('CANCELLED', 'Cancelled'),
('DELIVERED', 'Delivered'),
('IN_TRANSIT', 'In Transit'),
('OUT_FOR_DELIVERY', 'Out for Delivery'),
('PAYMENT_CONFIRMED', 'Payment Confirmed'),
('PENDING', 'Pending'),
('PREPARING_SHIPMENT', 'Preparing Shipment'),
('PROCESSING', 'Processing'),
('RECEIVED', 'Order Received'),
('REFUNDED', 'Refunded'),
('RETURNED', 'Returned'),
('SHIPPED', 'Shipped');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `token_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `token_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`token_id`, `user_id`, `token_hash`, `created_at`, `expires_at`) VALUES
(1, 3, '$2y$10$abc123def456ghi789jkl012mno345pqr678stu901vwx234yz567', '2026-03-27 07:49:55', '2026-12-15 22:59:59'),
(2, 12, '$2y$10$zyx987wvu654tsr321qpo765nml432kji109hgf876edc543ba210', '2026-03-27 07:49:55', '2026-11-30 22:59:59'),
(3, 25, '$2y$10$1a2b3c4d5e6f7g8h9i0j1k2l3m4n5o6p7q8r9s0t1u2v3w4x5y', '2026-03-27 07:49:55', '2026-12-10 22:59:59'),
(4, 37, '$2y$10$z9y8x7w6v5u4t3s2r1q0p9o8n7m6l5k4j3i2h1g0f9e8d7c6b5a', '2026-03-27 07:49:55', '2026-12-20 22:59:59'),
(5, 45, '$2y$10$5f6g7h8j9k0l1m2n3o4p5q6r7s8t9u0v1w2x3y4z5a6b7c8d9e', '2026-03-27 07:49:55', '2026-11-25 22:59:59'),
(6, 52, '$2y$10$9i8j7k6l5m4n3o2p1q0r9s8t7u6v5w4x3y2z1a0b9c8d7e6f5g', '2026-03-27 07:49:55', '2026-12-05 22:59:59'),
(7, 68, '$2y$10$3l4m5n6o7p8q9r0s1t2u3v4w5x6y7z8a9b0c1d2e3f4g5h6i7j', '2026-03-27 07:49:55', '2026-12-25 22:59:59'),
(8, 73, '$2y$10$7o8p9q0r1s2t3u4v5w6x7y8z9a0b1c2d3e4f5g6h7i8j9k0l1m', '2026-03-27 07:49:55', '2026-11-20 22:59:59'),
(9, 81, '$2y$10$2q3w4e5r6t7y8u9i0o1p2a3s4d5f6g7h8j9k0l1z2x3c4v5b6n', '2026-03-27 07:49:55', '2026-12-18 22:59:59'),
(10, 94, '$2y$10$6m5n4o3p2q1r0s9t8u7v6w5x4y3z2a1b0c9d8e7f6g5h4i3j2k', '2026-03-27 07:49:55', '2026-12-08 22:59:59'),
(11, 102, '$2y$10$1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y', '2026-03-27 07:49:55', '2026-12-30 22:59:59'),
(12, 115, '$2y$10$9z8y7x6w5v4u3t2s1r0q9p8o7n6m5l4k3j2i1h0g9f8e7d6c5b', '2026-03-27 07:49:55', '2026-11-28 22:59:59'),
(13, 121, '$2y$10$5a6b7c8d9e0f1g2h3i4j5k6l7m8n9o0p1q2r3s4t5u6v7w8x', '2026-03-27 07:49:55', '2026-12-12 22:59:59'),
(14, 108, '$2y$10$8x7w6v5u4t3s2r1q0p9o8n7m6l5k4j3i2h1g0f9e8d7c6b5a4z', '2026-03-27 07:49:55', '2026-12-22 22:59:59'),
(15, 102, '$2y$10$2d3e4f5g6h7i8j9k0l1m2n3o4p5q6r7s8t9u0v1w2x3y4z5a', '2026-03-27 07:49:55', '2026-11-15 22:59:59'),
(16, 17, '$2y$10$6f7g8h9i0j1k2l3m4n5o6p7q8r9s0t1u2v3w4x5y6z7a8b9c0d', '2026-03-27 07:49:55', '2026-12-03 22:59:59'),
(17, 29, '$2y$10$1k2l3m4n5o6p7q8r9s0t1u2v3w4x5y6z7a8b9c0d1e2f3g4h5i', '2026-03-27 07:49:55', '2026-12-28 22:59:59'),
(18, 42, '$2y$10$9p8o7n6m5l4k3j2i1h0g9f8e7d6c5b4a3z2x1w0v9u8t7s6r5q4p', '2026-03-27 07:49:55', '2026-11-10 22:59:59'),
(19, 55, '$2y$10$3s4t5u6v7w8x9y0z1a2b3c4d5e6f7g8h9i0j1k2l3m4n5o6p7q', '2026-03-27 07:49:55', '2026-12-17 22:59:59'),
(20, 65, '$2y$10$7v6w5x4y3z2a1b0c9d8e7f6g5h4i3j2k1l0m9n8o7p6q5r4s3t2u', '2026-03-27 07:49:55', '2026-11-05 22:59:59'),
(21, 77, '$2y$10$1x2y3z4a5b6c7d8e9f0g1h2i3j4k5l6m7n8o9p0q1r2s3t4u5v', '2026-03-27 07:49:55', '2026-12-27 22:59:59'),
(22, 88, '$2y$10$5q4r3s2t1u0v9w8x7y6z5a4b3c2d1e0f9g8h7i6j5k4l3m2n1o', '2026-03-27 07:49:55', '2026-12-01 22:59:59'),
(23, 99, '$2y$10$9t8u7v6w5x4y3z2a1b0c9d8e7f6g5h4i3j2k1l0m9n8o7p6q5r', '2026-03-27 07:49:55', '2026-11-18 22:59:59'),
(24, 110, '$2y$10$3u2v1w0x9y8z7a6b5c4d3e2f1g0h9i8j7k6l5m4n3o2p1q0r9s', '2026-03-27 07:49:55', '2026-12-29 22:59:59'),
(25, 91, '$2y$10$7s6r5q4p3o2n1m0l9k8j7i6h5g4f3e2d1c0b9a8z7y6x5w4v3u2t', '2026-03-27 07:49:55', '2026-12-07 22:59:59');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `material_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `product_type` enum('standard','custom') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`product_id`, `material_id`, `name`, `product_type`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Concrete Formwork Connector', 'standard', 12.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(2, 3, 'Ventilation Grille', 'standard', 8.75, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(3, 5, 'Electrical Box Cover', 'standard', 6.25, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(4, 7, 'Pipe Support Bracket', 'standard', 15.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(5, 9, 'Metal Wall Anchor', 'standard', 22.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(6, 11, 'Drainage Channel Segment', 'standard', 18.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(7, 13, 'Aluminium Window Latch', 'standard', 35.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(8, 15, 'Titanium Structural Node', 'standard', 85.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(9, 17, '3D Printed Concrete Tile', 'standard', 4.50, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(10, 19, 'Reinforced Nylon Dowel', 'standard', 3.75, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(11, 2, 'Custom Facade Panel', 'custom', 0.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(12, 4, 'Custom Duct Adapter', 'custom', 0.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(13, 6, 'Custom Cable Tray', 'custom', 0.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(14, 8, 'Custom Steel Beam Connector', 'custom', 0.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(15, 10, 'Custom Copper Pipe Fitting', 'custom', 0.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(16, 12, 'Custom Carbon Fiber Brace', 'custom', 0.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(17, 14, 'Custom Stainless Steel Hinge', 'custom', 0.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(18, 16, 'Custom Inconel Exhaust Part', 'custom', 0.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(19, 18, 'Custom Geopolymer Ornament', 'custom', 0.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(20, 20, 'Custom Wood-Filled Decor', 'custom', 0.00, '2026-03-27 07:49:55', '2026-03-27 07:49:55');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `roles`
--

CREATE TABLE `roles` (
  `role_code` varchar(20) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `roles`
--

INSERT INTO `roles` (`role_code`, `label`) VALUES
('ADMIN', 'Administrator'),
('USER', 'Regular User');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `kvk` char(8) NOT NULL,
  `role_code` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_id`, `kvk`, `role_code`, `email`, `password_hash`, `phone`, `created_at`, `updated_at`) VALUES
(1, '87654321', 'ADMIN', 'david@codeconquer.nl', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '+31612345678', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(2, '87654321', 'ADMIN', 'mark@codeconquer.nl', '$2y$10$N9qo8uLOickgx2ZMRZoMy.MrkvA656Dw5zJZJNcX5yY2Yv7JXQbO', '+31623456789', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(3, '87654321', 'ADMIN', 'sherwin@codeconquer.nl', '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdF', '+31634567890', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(4, '87654321', 'ADMIN', 'stefan@codeconquer.nl', '$2y$10$g7vI8vz5thU9Q3YXwNn8xuQjZvM1lZ4s7vQJZ8YXwNn8xuQjZvM1l', '+31645678901', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(5, '12345678', 'USER', 'emma@technova.nl', '$2y$10$Z7H8lP5qS3dK0fR1T6yVw2B8C9mN5xQ6R7J1L0aF2G3uP8H9dI', '+31610000001', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(6, '12345678', 'USER', 'noah@technova.nl', '$2y$10$M1Q9P6X3T4C7V8J2K5Y0L3N8R1S6A4F9B7D2U5W3H0G8E1T6K9', '+31610000002', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(7, '12345678', 'USER', 'liam@technova.nl', '$2y$10$V3R5N8C1H6T9L2P7X0F4S3Q8W5B1K6A9U2J0M7D4G8T1E3Y6L', '+31610000003', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(8, '23456789', 'USER', 'olivia@greenleaf.nl', '$2y$10$K9F6D1R3V7P0T4L8X2S5Q9C6H3N1B5A0M7J2W4U8G6E1Y9T3K', '+31610000004', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(9, '23456789', 'USER', 'mila@greenleaf.nl', '$2y$10$R2J5K8V1C4T6P3X9S0N7H2L5Q1B9A6F3M8W0D2U5G1E7Y4K3T', '+31610000005', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(10, '23456789', 'USER', 'lucas@greenleaf.nl', '$2y$10$P4T1N7H5R8C2V9X6L3S0Q4B7A1F5M2J9W6D3U0G8E1Y5K2T', '+31610000006', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(11, '34567890', 'USER', 'sophie@urbanbuild.nl', '$2y$10$H3K6C1T8P5R2X7V4L0S9Q3B5A1F6M2J8D4U0W7G1E5Y2T3K', '+31610000007', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(12, '34567890', 'USER', 'sem@urbanbuild.nl', '$2y$10$D5T2N7H1R9C4V6X3L0S8Q2B5A1F7M3J0W6D2U9G5E1Y4K8T', '+31610000008', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(13, '34567890', 'USER', 'zoe@urbanbuild.nl', '$2y$10$Q1V6X3C9H2T5P8L0S4R7B1A6F3M9J2W5D0U8G6E1Y3K7T9', '+31610000009', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(14, '45678901', 'USER', 'daan@brightmind.nl', '$2y$10$L4R2T7H1C5P8X3V6S0N9B4A1F7M2J5D8U1W6G3E0Y2K9T', '+31610000010', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(15, '45678901', 'USER', 'saar@brightmind.nl', '$2y$10$F2H5C8T1R4P7X3V9L0S6B2A5F1M8J3D9U6W0G2E4Y7K1T', '+31610000011', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(16, '45678901', 'USER', 'finn@brightmind.nl', '$2y$10$P6V3X1C9H2T5R8L4S0B7A1F6M3J9D2U5W0G8E1Y4K6T', '+31610000012', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(17, '56789012', 'USER', 'luca@swiftlogistics.nl', '$2y$10$T3C8H5R1P6X2V9L4S0N7B3A1F5M2J8D6U0W4G1E7Y2K9T', '+31610000013', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(18, '56789012', 'USER', 'eva@swiftlogistics.nl', '$2y$10$R1T6H3C8P2X5V9L4S0N7B1A5F3M2J8D6U0W4G1E7Y2K9T', '+31610000014', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(19, '56789012', 'USER', 'levi@swiftlogistics.nl', '$2y$10$F4X2C7H1R5T8P3V6L0S9B2A5F1M8J4D0U6W2G3E1Y5K7T', '+31610000015', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(20, '67890123', 'USER', 'noor@purewater.nl', '$2y$10$H1R4T7C2P5X8V3L0S6B9A1F4M2J7D5U0W3G1E8Y2K6T', '+31610000016', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(21, '67890123', 'USER', 'james@purewater.nl', '$2y$10$K3X6C1H4R8T2P5V9L0S7B3A1F6M3J8D2U0W4G1E7Y5K9T', '+31610000017', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(22, '67890123', 'USER', 'lars@purewater.nl', '$2y$10$R5T1H3C7P2X6V9L4S0B8A1F5M3J9D2U6W0G4E1Y7K3T', '+31610000018', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(23, '78901234', 'USER', 'isa@smartgrow.nl', '$2y$10$F1C8H4R2T5P9X3V6L0S7B3A1F6M2J9D4U0W5G1E8Y2K6T', '+31610000019', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(24, '78901234', 'USER', 'mason@smartgrow.nl', '$2y$10$T3H6C1R4T8P2X5V9L0S7B3A1F6M3J9D2U0W4G1E7Y5K3T', '+31610000020', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(25, '78901234', 'USER', 'lina@smartgrow.nl', '$2y$10$R2T5H1C8P3X6V9L4S0B7A1F4M2J8D5U0W3G1E7Y2K9T', '+31610000021', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(26, '89012345', 'USER', 'adam@ecopack.nl', '$2y$10$P4C8H2R7T1X5V9L0S3B6A1F4M2J8D5U0W7G1E3Y6K2T', '+31610000022', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(27, '89012345', 'USER', 'nina@ecopack.nl', '$2y$10$F3T6H1C4P8X2V5L9S0B7A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000023', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(28, '89012345', 'USER', 'max@ecopack.nl', '$2y$10$R1C4H7T2P5X8V3L0S6B9A1F4M2J7D5U0W3G1E8Y2K6T', '+31610000024', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(29, '90123456', 'USER', 'tess@datadrive.nl', '$2y$10$H2T5C1R8P3X6V9L4S0B7A1F4M2J8D5U0W3G1E7Y2K9T', '+31610000025', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(30, '90123456', 'USER', 'sam@datadrive.nl', '$2y$10$P1H3C6R4T8X2V5L9S0B7A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000026', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(31, '90123456', 'USER', 'ivy@datadrive.nl', '$2y$10$R5T2H1C3P6X9V4L0S7B3A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000027', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(32, '01234567', 'USER', 'alex@securenet.nl', '$2y$10$N1R4H6C2P8X3V5L9S0B7A1F4M2J8D5U0W3G1E7Y2K9T', '+31610000028', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(33, '01234567', 'USER', 'fay@securenet.nl', '$2y$10$T2C7H1R4P5X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000029', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(34, '01234567', 'USER', 'noor@securenet.nl', '$2y$10$R3T5H2C6P1X7V4L0S9B8A1F3M2J8D5U0W3G1E7Y2K9T', '+31610000030', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(35, '11223344', 'USER', 'mohamed@cloudflex.nl', '$2y$10$P4C8H2R7T1X5V9L0S3B6A1F4M2J8D5U0W7G1E3Y6K2T', '+31610000031', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(36, '11223344', 'USER', 'emma@cloudflex.nl', '$2y$10$F3T6H1C4P8X2V5L9S0B7A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000032', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(37, '11223344', 'USER', 'david@cloudflex.nl', '$2y$10$R1C4H7T2P5X8V3L0S6B9A1F4M2J7D5U0W3G1E8Y2K6T', '+31610000033', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(38, '22334455', 'USER', 'maya@agritech.nl', '$2y$10$H2T5C1R8P3X6V9L4S0B7A1F4M2J8D5U0W3G1E7Y2K9T', '+31610000034', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(39, '22334455', 'USER', 'noah@agritech.nl', '$2y$10$P1H3C6R4T8X2V5L9S0B7A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000035', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(40, '22334455', 'USER', 'sara@agritech.nl', '$2y$10$R5T2H1C3P6X9V4L0S7B3A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000036', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(41, '33445566', 'USER', 'finn@healthfirst.nl', '$2y$10$N3R6H1C5P9X2V4L0S7B3A1F4M2J8D5U0W3G1E7Y2K9T', '+31610000037', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(42, '33445566', 'USER', 'lina@healthfirst.nl', '$2y$10$T1C4H7R2P5X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000038', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(43, '33445566', 'USER', 'mason@healthfirst.nl', '$2y$10$R2T5H3C6P1X7V4L0S9B8A1F3M2J8D5U0W3G1E7Y2K9T', '+31610000039', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(44, '44556677', 'USER', 'sara@buildright.nl', '$2y$10$P5C8H2R7T1X5V9L0S3B6A1F4M2J8D5U0W7G1E3Y6K2T', '+31610000040', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(45, '44556677', 'USER', 'daan@buildright.nl', '$2y$10$F4T6H1C3P8X2V5L9S0B7A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000041', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(46, '44556677', 'USER', 'noor@buildright.nl', '$2y$10$R2C4H7T1P5X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000042', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(47, '55667788', 'USER', 'emma@financepro.nl', '$2y$10$H1T5C2R7P3X6V9L4S0B8A1F4M2J8D5U0W3G1E7Y2K9T', '+31610000043', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(48, '55667788', 'USER', 'finn@financepro.nl', '$2y$10$P3H1C6R4T8X2V5L9S0B7A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000044', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(49, '55667788', 'USER', 'maya@financepro.nl', '$2y$10$R1T4H2C5P7X9V3L0S6B8A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000045', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(50, '66778899', 'USER', 'noah@mediamakers.nl', '$2y$10$N2R5H1C4P7X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K9T', '+31610000046', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(51, '66778899', 'USER', 'lars@mediamakers.nl', '$2y$10$T3C6H1R4P5X8V2L0S7B9A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000047', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(52, '66778899', 'USER', 'zoe@mediamakers.nl', '$2y$10$R5T1H3C6P2X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000048', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(53, '77889900', 'USER', 'levi@autopartners.nl', '$2y$10$H3C6H1R5P8X2V4L0S7B9A1F3M2J8D5U0W3G1E7Y2K6T', '+31610000049', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(54, '77889900', 'USER', 'saar@autopartners.nl', '$2y$10$P2T5C1R7P4X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K3T', '+31610000050', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(55, '77889900', 'USER', 'adam@autopartners.nl', '$2y$10$R1H3C5T2P6X7V4L0S9B8A1F3M2J8D5U0W3G1E7Y2K9T', '+31610000051', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(56, '88990011', 'USER', 'olivia@freshfood.nl', '$2y$10$N5R2H1C4P7X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000052', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(57, '88990011', 'USER', 'mila@freshfood.nl', '$2y$10$T4C6H1R2P5X8V3L0S7B9A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000053', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(58, '88990011', 'USER', 'lucas@freshfood.nl', '$2y$10$R2T5H1C6P3X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000054', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(59, '99001122', 'USER', 'tess@edusmart.nl', '$2y$10$H1T4C3R7P5X8V2L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000055', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(60, '99001122', 'USER', 'sam@edusmart.nl', '$2y$10$P3H6C1R4T8X2V5L9S0B7A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000056', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(61, '99001122', 'USER', 'ivy@edusmart.nl', '$2y$10$R5T1H3C6P2X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000057', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(62, '00112233', 'USER', 'adam@cleanenergy.nl', '$2y$10$N2R5H1C4P7X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000058', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(63, '00112233', 'USER', 'noor@cleanenergy.nl', '$2y$10$T3C6H1R4P5X8V2L0S7B9A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000059', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(64, '00112233', 'USER', 'liam@cleanenergy.nl', '$2y$10$R5T1H3C6P2X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000060', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(65, '12344321', 'USER', 'sophie@urbanplanning.nl', '$2y$10$H3C6H1R5P8X2V4L0S7B9A1F3M2J8D5U0W3G1E7Y2K6T', '+31610000061', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(66, '12344321', 'USER', 'daan@urbanplanning.nl', '$2y$10$P2T5C1R7P4X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K3T', '+31610000062', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(67, '12344321', 'USER', 'maya@urbanplanning.nl', '$2y$10$R1H3C5T2P6X7V4L0S9B8A1F3M2J8D5U0W3G1E7Y2K9T', '+31610000063', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(68, '23455432', 'USER', 'emma@safeguard.nl', '$2y$10$K3H5C1T4P8X2V6L0S9B7A1F3M2J8D5U0W3G1E7Y2K6T', '+31610000064', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(69, '23455432', 'USER', 'noah@safeguard.nl', '$2y$10$R1T4H2C5P7X9V3L0S6B8A1F4M2J8D5U0W3G1E7Y2K9T', '+31610000065', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(70, '23455432', 'USER', 'lina@safeguard.nl', '$2y$10$F2C5H1R3P6X8V4L0S7B9A1F4M2J8D5U0W3G1E7Y2K3T', '+31610000066', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(71, '34566543', 'USER', 'lucas@travelease.nl', '$2y$10$P4H2C7T1R5X8V3L0S6B9A1F3M2J8D5U0W3G1E7Y2K6T', '+31610000067', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(72, '34566543', 'USER', 'maya@travelease.nl', '$2y$10$R3T5H1C8P2X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000068', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(73, '34566543', 'USER', 'finn@travelease.nl', '$2y$10$H1C4T7R2P5X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K3T', '+31610000069', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(74, '45677654', 'USER', 'sara@homecomfort.nl', '$2y$10$P2T5H1C7R4X8V3L0S6B9A1F3M2J8D5U0W3G1E7Y2K6T', '+31610000070', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(75, '45677654', 'USER', 'adam@homecomfort.nl', '$2y$10$R1C3H5T2P6X7V4L0S9B8A1F3M2J8D5U0W3G1E7Y2K9T', '+31610000071', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(76, '45677654', 'USER', 'olivia@homecomfort.nl', '$2y$10$F4H2C7T1P5X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K3T', '+31610000072', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(77, '56788765', 'USER', 'levi@fashionforward.nl', '$2y$10$H3C6H1R5P8X2V4L0S7B9A1F3M2J8D5U0W3G1E7Y2K6T', '+31610000073', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(78, '56788765', 'USER', 'saar@fashionforward.nl', '$2y$10$P2T5C1R7P4X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K3T', '+31610000074', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(79, '56788765', 'USER', 'adam@fashionforward.nl', '$2y$10$R1H3C5T2P6X7V4L0S9B8A1F3M2J8D5U0W3G1E7Y2K9T', '+31610000075', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(80, '67899876', 'USER', 'emma@techwise.nl', '$2y$10$N5R2H1C4P7X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000076', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(81, '67899876', 'USER', 'mila@techwise.nl', '$2y$10$T4C6H1R2P5X8V3L0S7B9A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000077', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(82, '67899876', 'USER', 'noor@techwise.nl', '$2y$10$R2T5H1C6P3X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000078', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(83, '78900987', 'USER', 'finn@greenearth.nl', '$2y$10$H1T4C3R7P5X8V2L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000079', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(84, '78900987', 'USER', 'lina@greenearth.nl', '$2y$10$P3H6C1R4T8X2V5L9S0B7A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000080', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(85, '78900987', 'USER', 'noah@greenearth.nl', '$2y$10$R5T1H3C6P2X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000081', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(86, '89011098', 'USER', 'lucas@logispeed.nl', '$2y$10$N2R5H1C4P7X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000082', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(87, '89011098', 'USER', 'maya@logispeed.nl', '$2y$10$T3C6H1R4P5X8V2L0S7B9A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000083', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(88, '89011098', 'USER', 'finn@logispeed.nl', '$2y$10$R5T1H3C6P2X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000084', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(89, '90122109', 'USER', 'saar@medcare.nl', '$2y$10$H3C6H1R5P8X2V4L0S7B9A1F3M2J8D5U0W3G1E7Y2K6T', '+31610000085', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(90, '90122109', 'USER', 'adam@medcare.nl', '$2y$10$P2T5C1R7P4X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K3T', '+31610000086', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(91, '90122109', 'USER', 'olivia@medcare.nl', '$2y$10$R1H3C5T2P6X7V4L0S9B8A1F3M2J8D5U0W3G1E7Y2K9T', '+31610000087', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(92, '01233210', 'USER', 'levi@smarthome.nl', '$2y$10$N5R2H1C4P7X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000088', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(93, '01233210', 'USER', 'saar@smarthome.nl', '$2y$10$T4C6H1R2P5X8V3L0S7B9A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000089', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(94, '01233210', 'USER', 'adam@smarthome.nl', '$2y$10$R2T5H1C6P3X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000090', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(95, '11222331', 'USER', 'emma@agrivision.nl', '$2y$10$H1T4C3R7P5X8V2L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000091', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(96, '11222331', 'USER', 'finn@agrivision.nl', '$2y$10$P3H6C1R4T8X2V5L9S0B7A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000092', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(97, '11222331', 'USER', 'maya@agrivision.nl', '$2y$10$R5T1H3C6P2X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000093', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(98, '22333442', 'USER', 'noah@datasecure.nl', '$2y$10$N2R5H1C4P7X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000094', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(99, '22333442', 'USER', 'lina@datasecure.nl', '$2y$10$T3C6H1R4P5X8V2L0S7B9A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000095', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(100, '22333442', 'USER', 'lucas@datasecure.nl', '$2y$10$R5T1H3C6P2X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000096', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(101, '33444553', 'USER', 'sophia@buildsmart.nl', '$2y$10$H3C6H1R5P8X2V4L0S7B9A1F3M2J8D5U0W3G1E7Y2K6T', '+31610000097', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(102, '33444553', 'USER', 'daan@buildsmart.nl', '$2y$10$P2T5C1R7P4X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K3T', '+31610000098', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(103, '33444553', 'USER', 'noor@buildsmart.nl', '$2y$10$R1H3C5T2P6X7V4L0S9B8A1F3M2J8D5U0W3G1E7Y2K9T', '+31610000099', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(104, '44555664', 'USER', 'emma@fintech.nl', '$2y$10$N5R2H1C4P7X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000100', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(105, '44555664', 'USER', 'finn@fintech.nl', '$2y$10$T4C6H1R2P5X8V3L0S7B9A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000101', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(106, '44555664', 'USER', 'maya@fintech.nl', '$2y$10$R2T5H1C6P3X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000102', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(107, '55666775', 'USER', 'noah@mediawave.nl', '$2y$10$H1T4C3R7P5X8V2L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000103', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(108, '55666775', 'USER', 'lina@mediawave.nl', '$2y$10$P3H6C1R4T8X2V5L9S0B7A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000104', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(109, '55666775', 'USER', 'lucas@mediawave.nl', '$2y$10$R5T1H3C6P2X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000105', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(110, '66777886', 'USER', 'sophia@autoservice.nl', '$2y$10$N2R5H1C4P7X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000106', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(111, '66777886', 'USER', 'adam@autoservice.nl', '$2y$10$T3C6H1R4P5X8V2L0S7B9A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000107', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(112, '66777886', 'USER', 'levi@autoservice.nl', '$2y$10$R5T1H3C6P2X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000108', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(113, '77888997', 'USER', 'saar@freshstart.nl', '$2y$10$H3C6H1R5P8X2V4L0S7B9A1F3M2J8D5U0W3G1E7Y2K6T', '+31610000109', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(114, '77888997', 'USER', 'finn@freshstart.nl', '$2y$10$P2T5C1R7P4X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K3T', '+31610000110', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(115, '77888997', 'USER', 'maya@freshstart.nl', '$2y$10$R1H3C5T2P6X7V4L0S9B8A1F3M2J8D5U0W3G1E7Y2K9T', '+31610000111', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(116, '88999008', 'USER', 'emma@eduvision.nl', '$2y$10$N5R2H1C4P7X8V3L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000112', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(117, '88999008', 'USER', 'lars@eduvision.nl', '$2y$10$T4C6H1R2P5X8V3L0S7B9A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000113', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(118, '88999008', 'USER', 'noor@eduvision.nl', '$2y$10$R2T5H1C6P3X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000114', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(119, '99000119', 'USER', 'finn@cleantech.nl', '$2y$10$H1T4C3R7P5X8V2L0S6B9A1F4M2J8D5U0W3G1E7Y2K6T', '+31610000115', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(120, '99000119', 'USER', 'lina@cleantech.nl', '$2y$10$P3H6C1R4T8X2V5L9S0B7A1F3M2J8D6U0W4G1E7Y2K3T', '+31610000116', '2026-03-27 07:49:55', '2026-03-27 07:49:55'),
(121, '99000119', 'USER', 'sara@cleantech.nl', '$2y$10$R5T1H3C6P2X7V4L0S9B8A1F5M2J8D6U0W3G1E7Y2K9T', '+31610000117', '2026-03-27 07:49:55', '2026-03-27 07:49:55');

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `view_users`
-- (Zie onder voor de actuele view)
--
CREATE TABLE `view_users` (
`user_id` int(10) unsigned
,`kvk` char(8)
,`role_code` varchar(20)
,`created_at` timestamp
);

-- --------------------------------------------------------

--
-- Structuur voor de view `view_users`
--
DROP TABLE IF EXISTS `view_users`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_users`  AS SELECT `users`.`user_id` AS `user_id`, `users`.`kvk` AS `kvk`, `users`.`role_code` AS `role_code`, `users`.`created_at` AS `created_at` FROM `users` ;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `catalog_products`
--
ALTER TABLE `catalog_products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexen voor tabel `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`kvk`);

--
-- Indexen voor tabel `custom_products`
--
ALTER TABLE `custom_products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexen voor tabel `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_orders_user` (`user_id`),
  ADD KEY `fk_orders_order_status` (`status_code`);

--
-- Indexen voor tabel `order_line_items`
--
ALTER TABLE `order_line_items`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `fk_order_line_items_product` (`product_id`);

--
-- Indexen voor tabel `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`status_code`);

--
-- Indexen voor tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `fk_password_reset_tokens_user` (`user_id`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_material` (`material_id`);

--
-- Indexen voor tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_code`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_company` (`kvk`),
  ADD KEY `fk_users_role` (`role_code`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT voor een tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT voor een tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `token_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `catalog_products`
--
ALTER TABLE `catalog_products`
  ADD CONSTRAINT `fk_catalog_products_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `custom_products`
--
ALTER TABLE `custom_products`
  ADD CONSTRAINT `fk_custom_products_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_order_status` FOREIGN KEY (`status_code`) REFERENCES `order_statuses` (`status_code`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Beperkingen voor tabel `order_line_items`
--
ALTER TABLE `order_line_items`
  ADD CONSTRAINT `fk_order_line_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_order_line_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Beperkingen voor tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `fk_password_reset_tokens_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Beperkingen voor tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_material` FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`);

--
-- Beperkingen voor tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_company` FOREIGN KEY (`kvk`) REFERENCES `companies` (`kvk`),
  ADD CONSTRAINT `fk_users_role` FOREIGN KEY (`role_code`) REFERENCES `roles` (`role_code`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
