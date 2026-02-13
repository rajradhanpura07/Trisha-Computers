

CREATE DATABASE trisha_computers;
USE trisha_computers;
-- =========================
-- ADMIN
-- =========================
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(150) NOT NULL,
    password VARCHAR(255) NOT NULL,   -- store HASH only
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- =========================
-- CLIENTS
-- =========================
CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    company VARCHAR(150),
    email VARCHAR(150),
    phone VARCHAR(20),
    website VARCHAR(150),
    address1 TEXT,
    address2 TEXT,
    city VARCHAR(100),
    state VARCHAR(100),
    zip VARCHAR(20),
    priority VARCHAR(50),
    info TEXT
);

CREATE TABLE client_branches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    branch_name VARCHAR(150),
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
);

-- =========================
-- SERVERS
-- =========================
CREATE TABLE servers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(150),
    company_branch VARCHAR(150),
    server_name VARCHAR(150),
    server_ip VARCHAR(50),
    port VARCHAR(20),
    username VARCHAR(100),
    password VARCHAR(100),
    domain VARCHAR(150),
    qh_key TEXT,
    qh_password TEXT,
    qh_expiry DATE
);

-- =========================
-- SWITCHES
-- =========================
CREATE TABLE switches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client VARCHAR(150),
    company_branch VARCHAR(150),
    switch_ip VARCHAR(50),
    username VARCHAR(100),
    password VARCHAR(100),
    model_no VARCHAR(150),
    serial_no VARCHAR(150),
    location VARCHAR(150),
    mac_address VARCHAR(100)
);

CREATE TABLE switch_vlans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    switch_id INT,
    vlan_id VARCHAR(20),
    vlan_name VARCHAR(100),
    vlan_ip VARCHAR(50),
    FOREIGN KEY (switch_id) REFERENCES switches(id) ON DELETE CASCADE
);

-- =========================
-- ROUTERS
-- =========================
CREATE TABLE routers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(150),
    company_branch VARCHAR(150),
    router_name VARCHAR(150),
    router_ip VARCHAR(50),
    username VARCHAR(100),
    password VARCHAR(100),
    model_no VARCHAR(150),
    serial_no VARCHAR(150),
    location VARCHAR(150),
    mac_address VARCHAR(100)
);

CREATE TABLE router_ssids (
    id INT AUTO_INCREMENT PRIMARY KEY,
    router_id INT,
    vlan_id VARCHAR(20),
    vlan_name VARCHAR(100),
    vlan_ip VARCHAR(50),
    FOREIGN KEY (router_id) REFERENCES routers(id) ON DELETE CASCADE
);

-- =========================
-- CAMERAS
-- =========================
CREATE TABLE cameras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(150),
    company_branch VARCHAR(150),
    camera_no VARCHAR(50),
    camera_ip VARCHAR(50),
    camera_model VARCHAR(150),
    camera_serial_no VARCHAR(150),
    camera_location VARCHAR(150),
    username VARCHAR(100),
    password VARCHAR(100),
    mac_address VARCHAR(100),
    gateway VARCHAR(50),
    subnet VARCHAR(50)
);

-- =========================
-- FIREWALLS
-- =========================
CREATE TABLE firewalls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client VARCHAR(150),
    company_branch VARCHAR(150),
    firewall_ip VARCHAR(50),
    static_ip VARCHAR(50),
    model_no VARCHAR(150),
    serial_no VARCHAR(150),
    username VARCHAR(100),
    password VARCHAR(100),
    version VARCHAR(100),
    owner VARCHAR(150),
    expiry_date DATE,
    console_port VARCHAR(50),
    port_user VARCHAR(50),
    port_vpn VARCHAR(50),
    backup_set VARCHAR(100),
    storage_password VARCHAR(150)
);

-- =========================
-- NVRS
-- =========================
CREATE TABLE nvrs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(150),
    company_branch VARCHAR(150),
    nvr_ip VARCHAR(50),
    nvr_model VARCHAR(150),
    nvr_channel VARCHAR(50),
    username VARCHAR(100),
    password VARCHAR(100),
    serial_no VARCHAR(150),
    mac_address VARCHAR(100)
);

-- =========================
-- PRINTERS
-- =========================
CREATE TABLE printers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client VARCHAR(150),
    printer_name VARCHAR(150),
    printer_ip VARCHAR(50),
    model_no VARCHAR(150),
    serial_no VARCHAR(150),
    username VARCHAR(100),
    password VARCHAR(100),
    mac_address VARCHAR(100),
    location VARCHAR(150),
    vlan VARCHAR(50),
    vlan_id VARCHAR(20),
    vlan_ip VARCHAR(50)
);


