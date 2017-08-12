/*
Navicat PGSQL Data Transfer

Source Server         : PostgreSQL
Source Server Version : 90603
Source Host           : localhost:5432
Source Database       : mitrasi-pos-beta
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90603
File Encoding         : 65001

Date: 2017-08-12 22:55:03
*/


-- ----------------------------
-- Sequence structure for m_customer_customer_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_customer_customer_id_seq";
CREATE SEQUENCE "public"."m_customer_customer_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
SELECT setval('"public"."m_customer_customer_id_seq"', 1, true);

-- ----------------------------
-- Sequence structure for m_diskon_diskon_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_diskon_diskon_id_seq";
CREATE SEQUENCE "public"."m_diskon_diskon_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
SELECT setval('"public"."m_diskon_diskon_id_seq"', 1, true);

-- ----------------------------
-- Sequence structure for m_employee_employee_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_employee_employee_id_seq";
CREATE SEQUENCE "public"."m_employee_employee_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for m_employee_type_employee_type_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_employee_type_employee_type_id_seq";
CREATE SEQUENCE "public"."m_employee_type_employee_type_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;

-- ----------------------------
-- Sequence structure for m_gratuity_gratuity_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_gratuity_gratuity_id_seq";
CREATE SEQUENCE "public"."m_gratuity_gratuity_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
SELECT setval('"public"."m_gratuity_gratuity_id_seq"', 1, true);

-- ----------------------------
-- Sequence structure for m_item_item_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_item_item_id_seq";
CREATE SEQUENCE "public"."m_item_item_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 18
 CACHE 1;
SELECT setval('"public"."m_item_item_id_seq"', 18, true);

-- ----------------------------
-- Sequence structure for m_itemdet_itemdet_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_itemdet_itemdet_id_seq";
CREATE SEQUENCE "public"."m_itemdet_itemdet_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 23
 CACHE 1;
SELECT setval('"public"."m_itemdet_itemdet_id_seq"', 23, true);

-- ----------------------------
-- Sequence structure for m_kategori_kategori_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_kategori_kategori_id_seq";
CREATE SEQUENCE "public"."m_kategori_kategori_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 3
 CACHE 1;
SELECT setval('"public"."m_kategori_kategori_id_seq"', 3, true);

-- ----------------------------
-- Sequence structure for m_outlet_outlet_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_outlet_outlet_id_seq";
CREATE SEQUENCE "public"."m_outlet_outlet_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2
 CACHE 1;
SELECT setval('"public"."m_outlet_outlet_id_seq"', 2, true);

-- ----------------------------
-- Sequence structure for m_pajak_pajak_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_pajak_pajak_id_seq";
CREATE SEQUENCE "public"."m_pajak_pajak_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
SELECT setval('"public"."m_pajak_pajak_id_seq"', 1, true);

-- ----------------------------
-- Sequence structure for m_supplier_supplier_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."m_supplier_supplier_id_seq";
CREATE SEQUENCE "public"."m_supplier_supplier_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 1
 CACHE 1;
SELECT setval('"public"."m_supplier_supplier_id_seq"', 1, true);

-- ----------------------------
-- Sequence structure for s_menu_menu_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."s_menu_menu_id_seq";
CREATE SEQUENCE "public"."s_menu_menu_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 18
 CACHE 1;
SELECT setval('"public"."s_menu_menu_id_seq"', 18, true);

-- ----------------------------
-- Sequence structure for s_privilege_privilege_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."s_privilege_privilege_id_seq";
CREATE SEQUENCE "public"."s_privilege_privilege_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 20
 CACHE 1;

-- ----------------------------
-- Sequence structure for s_stok_stok_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."s_stok_stok_id_seq";
CREATE SEQUENCE "public"."s_stok_stok_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 6
 CACHE 1;
SELECT setval('"public"."s_stok_stok_id_seq"', 6, true);

-- ----------------------------
-- Sequence structure for t_adjustment_adjustment_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."t_adjustment_adjustment_id_seq";
CREATE SEQUENCE "public"."t_adjustment_adjustment_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 2
 CACHE 1;
SELECT setval('"public"."t_adjustment_adjustment_id_seq"', 2, true);

-- ----------------------------
-- Sequence structure for t_adjustmentdet_adjustmentdet_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."t_adjustmentdet_adjustmentdet_id_seq";
CREATE SEQUENCE "public"."t_adjustmentdet_adjustmentdet_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5
 CACHE 1;
SELECT setval('"public"."t_adjustmentdet_adjustmentdet_id_seq"', 5, true);

-- ----------------------------
-- Sequence structure for t_transfer_transfer_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."t_transfer_transfer_id_seq";
CREATE SEQUENCE "public"."t_transfer_transfer_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 4
 CACHE 1;
SELECT setval('"public"."t_transfer_transfer_id_seq"', 4, true);

-- ----------------------------
-- Sequence structure for t_transferdet_transferdet_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."t_transferdet_transferdet_id_seq";
CREATE SEQUENCE "public"."t_transferdet_transferdet_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 5
 CACHE 1;
SELECT setval('"public"."t_transferdet_transferdet_id_seq"', 5, true);

-- ----------------------------
-- Table structure for m_customer
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_customer";
CREATE TABLE "public"."m_customer" (
"customer_id" int4 DEFAULT nextval('m_customer_customer_id_seq'::regclass) NOT NULL,
"customer_nama" varchar(255) COLLATE "default",
"customer_email" varchar(255) COLLATE "default",
"customer_telepon" varchar(255) COLLATE "default",
"customer_birthday" date,
"customer_alamat" varchar(255) COLLATE "default",
"customer_kota" varchar(255) COLLATE "default",
"customer_provinsi" varchar(255) COLLATE "default",
"customer_kodepos" varchar(255) COLLATE "default",
"customer_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"customer_created_date" date,
"customer_created_time" time(6),
"customer_created_by" varchar(255) COLLATE "default",
"customer_updated_date" date,
"customer_updated_time" time(6),
"customer_updated_by" varchar(255) COLLATE "default",
"customer_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of m_customer
-- ----------------------------
INSERT INTO "public"."m_customer" VALUES ('1', 'Customer 1', '', '0812', '1990-01-01', '-', 'Surabaya', 'Jawa Timur', '', 'y', '2017-08-11', '23:43:54', 'admin', '2017-08-12', '22:11:51', 'admin', '3');

-- ----------------------------
-- Table structure for m_diskon
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_diskon";
CREATE TABLE "public"."m_diskon" (
"diskon_id" int4 DEFAULT nextval('m_diskon_diskon_id_seq'::regclass) NOT NULL,
"diskon_nama" varchar(255) COLLATE "default",
"diskon_type" char(1) COLLATE "default" DEFAULT 0,
"diskon_target" int4,
"diskon_outlet" int4 DEFAULT 0,
"diskon_satuan" char(1) COLLATE "default" DEFAULT 0,
"diskon_value" numeric(10,2),
"diskon_keterangan" varchar(255) COLLATE "default",
"diskon_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"diskon_created_date" date,
"diskon_created_time" time(6),
"diskon_created_by" varchar(255) COLLATE "default",
"diskon_updated_date" date,
"diskon_updated_time" time(6),
"diskon_updated_by" varchar COLLATE "default",
"diskon_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."m_diskon"."diskon_type" IS '0 = Per nota, 1 = Per kategori, 2 = Per item';
COMMENT ON COLUMN "public"."m_diskon"."diskon_target" IS 'jika diskon_type = 0 maka diisi 0, jika = 1 maka diisi id_kategori yang dipilih, jika 2 maka diisi id_item yang dipilih';
COMMENT ON COLUMN "public"."m_diskon"."diskon_outlet" IS '0 = Semua Outlet, (:num) = Outlet Tertentu';
COMMENT ON COLUMN "public"."m_diskon"."diskon_satuan" IS '0 = %, 1 = Rp';
COMMENT ON COLUMN "public"."m_diskon"."diskon_status_aktif" IS 'n = Tidak Aktif, y = Aktif';

-- ----------------------------
-- Records of m_diskon
-- ----------------------------
INSERT INTO "public"."m_diskon" VALUES ('1', 'Diskon 1', '1', '2', '0', '1', '10000.00', '', 'y', '2017-07-28', '01:31:32', 'admin', '2017-07-28', '22:11:32', 'admin', '12');

-- ----------------------------
-- Table structure for m_employee
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_employee";
CREATE TABLE "public"."m_employee" (
"employee_id" int4 DEFAULT nextval('m_employee_employee_id_seq'::regclass) NOT NULL,
"employee_type_id" int4,
"employee_nama" varchar(255) COLLATE "default",
"employee_email" varchar(255) COLLATE "default",
"employee_telepon" varchar(255) COLLATE "default",
"employee_birthday" date,
"employee_alamat" varchar(255) COLLATE "default",
"employee_kota" varchar(255) COLLATE "default",
"employee_provinsi" varchar(255) COLLATE "default",
"employee_kodepos" varchar(255) COLLATE "default",
"employee_username" varchar(255) COLLATE "default",
"employee_password" varchar(255) COLLATE "default",
"employee_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"employee_created_date" date,
"employee_created_time" time(6),
"employee_created_by" varchar(255) COLLATE "default",
"employee_updated_date" date,
"employee_updated_time" time(6),
"employee_updated_by" varchar(255) COLLATE "default",
"employee_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."m_employee"."employee_status_aktif" IS 'n = Tidak, y = Ya';

-- ----------------------------
-- Records of m_employee
-- ----------------------------
INSERT INTO "public"."m_employee" VALUES ('1', '1', 'Administrator', null, null, null, null, null, null, null, 'admin', '5cbc1fb2952638a54ccc08f1a2d51d7f', 'y', null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for m_employee_type
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_employee_type";
CREATE TABLE "public"."m_employee_type" (
"employee_type_id" int4 DEFAULT nextval('m_employee_type_employee_type_id_seq'::regclass) NOT NULL,
"employee_type_nama" varchar(255) COLLATE "default",
"employee_type_keterangan" varchar(255) COLLATE "default",
"employee_type_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"employee_type_created_date" date,
"employee_type_created_time" time(6),
"employee_type_created_by" varchar(255) COLLATE "default",
"employee_type_updated_date" date,
"employee_type_updated_time" time(6),
"employee_type_updated_by" varchar COLLATE "default",
"employee_type_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."m_employee_type"."employee_type_status_aktif" IS 'n = Tidak Aktif, y = Aktif';

-- ----------------------------
-- Records of m_employee_type
-- ----------------------------
INSERT INTO "public"."m_employee_type" VALUES ('1', 'Administrator', '-', 'y', null, null, null, '2017-08-12', '22:54:11', 'admin', '1');

-- ----------------------------
-- Table structure for m_gratuity
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_gratuity";
CREATE TABLE "public"."m_gratuity" (
"gratuity_id" int4 DEFAULT nextval('m_gratuity_gratuity_id_seq'::regclass) NOT NULL,
"gratuity_nama" varchar(255) COLLATE "default",
"gratuity_value" numeric(10,2) DEFAULT 0,
"gratuity_outlet" int4 DEFAULT 0,
"gratuity_keterangan" varchar(255) COLLATE "default",
"gratuity_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"gratuity_created_date" date,
"gratuity_created_time" time(6),
"gratuity_created_by" varchar(255) COLLATE "default",
"gratuity_updated_date" date,
"gratuity_updated_time" time(6),
"gratuity_updated_by" varchar COLLATE "default",
"gratuity_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."m_gratuity"."gratuity_outlet" IS '0 = Semua Outlet, (:num) = Outlet Tertentu';
COMMENT ON COLUMN "public"."m_gratuity"."gratuity_status_aktif" IS 'n = Tidak Aktif, y = Aktif';

-- ----------------------------
-- Records of m_gratuity
-- ----------------------------
INSERT INTO "public"."m_gratuity" VALUES ('1', 'Gratuity 1', '5.00', '0', '', 'y', '2017-07-28', '00:59:12', 'admin', '2017-07-28', '02:01:44', 'admin', '6');

-- ----------------------------
-- Table structure for m_item
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_item";
CREATE TABLE "public"."m_item" (
"item_id" int4 DEFAULT nextval('m_item_item_id_seq'::regclass) NOT NULL,
"item_nama" varchar(255) COLLATE "default",
"kategori_id" int4 DEFAULT 0,
"item_outlet" int4 DEFAULT 0,
"item_keterangan" varchar(255) COLLATE "default",
"item_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"item_created_date" date,
"item_created_time" time(6),
"item_created_by" varchar(255) COLLATE "default",
"item_updated_date" date,
"item_updated_time" time(6),
"item_updated_by" varchar COLLATE "default",
"item_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."m_item"."kategori_id" IS '0 = Tidak dikategorikan, (:num) = Kategori tertentu';
COMMENT ON COLUMN "public"."m_item"."item_outlet" IS '0 = Semua Outlet, (:num) = Outlet Tertentu';
COMMENT ON COLUMN "public"."m_item"."item_status_aktif" IS 'n = Tidak Aktif, y = Aktif';

-- ----------------------------
-- Records of m_item
-- ----------------------------
INSERT INTO "public"."m_item" VALUES ('1', 'Sate', '0', '0', '-', 'y', '2017-08-01', '03:53:51', 'admin', '2017-08-01', '04:38:08', 'admin', '7');
INSERT INTO "public"."m_item" VALUES ('2', 'Bakso', '0', '0', '', 'y', '2017-08-01', '03:56:24', 'admin', '2017-08-07', '23:08:23', 'admin', '11');
INSERT INTO "public"."m_item" VALUES ('3', 'Item 1', '0', '0', '', 'y', '2017-08-01', '04:40:15', 'admin', '2017-08-01', '04:46:38', 'admin', '1');
INSERT INTO "public"."m_item" VALUES ('18', 'Item 2', '0', '0', '', 'y', '2017-08-01', '05:24:52', 'admin', '2017-08-07', '23:17:16', 'admin', '2');

-- ----------------------------
-- Table structure for m_itemdet
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_itemdet";
CREATE TABLE "public"."m_itemdet" (
"itemdet_id" int4 DEFAULT nextval('m_itemdet_itemdet_id_seq'::regclass) NOT NULL,
"itemdet_nama" varchar(255) COLLATE "default",
"item_id" int4,
"itemdet_harga" int4,
"itemdet_sku" varchar COLLATE "default",
"itemdet_istrack_stock" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"itemdet_islimit_alert" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"itemdet_limit" int4,
"itemdet_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"itemdet_created_date" date,
"itemdet_created_time" time(6),
"itemdet_created_by" varchar(255) COLLATE "default",
"itemdet_updated_date" date,
"itemdet_updated_time" time(6),
"itemdet_updated_by" varchar COLLATE "default",
"itemdet_revised" int4
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."m_itemdet"."itemdet_istrack_stock" IS 'n = Tidak, y = Ya';
COMMENT ON COLUMN "public"."m_itemdet"."itemdet_islimit_alert" IS 'n = Tidak, y = Ya';
COMMENT ON COLUMN "public"."m_itemdet"."itemdet_status_aktif" IS 'n = Tidak Aktif, y = Aktif';

-- ----------------------------
-- Records of m_itemdet
-- ----------------------------
INSERT INTO "public"."m_itemdet" VALUES ('7', 'Ayam', '1', '10000', '-', 'y', 'y', '10', 'y', '2017-08-01', '04:38:08', 'admin', '2017-08-01', '04:38:08', 'admin', '0');
INSERT INTO "public"."m_itemdet" VALUES ('8', 'Kambing', '1', '20000', '-', 'y', 'y', '20', 'y', '2017-08-01', '04:38:08', 'admin', '2017-08-01', '04:38:08', 'admin', '0');
INSERT INTO "public"."m_itemdet" VALUES ('9', 'Kikil', '2', '10000', '-', 'y', 'y', '10', 'y', '2017-08-01', '04:39:10', 'admin', '2017-08-07', '23:08:23', 'admin', '3');
INSERT INTO "public"."m_itemdet" VALUES ('10', 'Sapi', '2', '10000', '-', 'y', 'y', '10', 'y', '2017-08-01', '04:39:10', 'admin', '2017-08-07', '23:08:23', 'admin', '3');
INSERT INTO "public"."m_itemdet" VALUES ('12', null, '3', '12000', '-', 'n', 'n', '10', 'y', '2017-08-01', '04:46:38', 'admin', '2017-08-01', '04:46:38', 'admin', '0');
INSERT INTO "public"."m_itemdet" VALUES ('22', null, '18', '20000', '-', 'y', 'y', '10', 'y', '2017-08-01', '05:25:42', 'admin', '2017-08-07', '23:17:17', 'admin', '1');
INSERT INTO "public"."m_itemdet" VALUES ('23', 'Mercon', '2', '15000', '-', 'y', 'y', '10', 'y', '2017-08-07', '23:08:23', 'admin', '2017-08-07', '23:08:23', 'admin', '0');

-- ----------------------------
-- Table structure for m_kategori
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_kategori";
CREATE TABLE "public"."m_kategori" (
"kategori_id" int4 DEFAULT nextval('m_kategori_kategori_id_seq'::regclass) NOT NULL,
"kategori_nama" varchar(255) COLLATE "default",
"kategori_outlet" int4 DEFAULT 0,
"kategori_keterangan" varchar(255) COLLATE "default",
"kategori_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"kategori_created_date" date,
"kategori_created_time" time(6),
"kategori_created_by" varchar(255) COLLATE "default",
"kategori_updated_date" date,
"kategori_updated_time" time(6),
"kategori_updated_by" varchar COLLATE "default",
"kategori_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."m_kategori"."kategori_outlet" IS '0 = Semua Outlet, (:num) = Outlet Tertentu';
COMMENT ON COLUMN "public"."m_kategori"."kategori_status_aktif" IS 'n = Tidak, y = Ya';

-- ----------------------------
-- Records of m_kategori
-- ----------------------------
INSERT INTO "public"."m_kategori" VALUES ('1', 'Kategori 1', '0', '-', 'y', '2017-07-28', '00:33:20', 'admin', '2017-07-31', '22:45:20', 'admin', '7');
INSERT INTO "public"."m_kategori" VALUES ('2', 'Kategori 2', '2', '', 'y', '2017-07-28', '00:33:38', 'admin', '2017-08-01', '05:34:31', 'admin', '15');
INSERT INTO "public"."m_kategori" VALUES ('3', 'Kategori 3', '0', '-', 'y', '2017-07-31', '22:45:29', 'admin', '2017-07-31', '22:45:29', 'admin', '0');

-- ----------------------------
-- Table structure for m_outlet
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_outlet";
CREATE TABLE "public"."m_outlet" (
"outlet_id" int4 DEFAULT nextval('m_outlet_outlet_id_seq'::regclass) NOT NULL,
"outlet_nama" varchar(255) COLLATE "default",
"outlet_alamat" varchar(255) COLLATE "default",
"outlet_telepon" varchar(255) COLLATE "default",
"outlet_kota" varchar(255) COLLATE "default",
"outlet_keterangan" varchar(255) COLLATE "default",
"outlet_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"outlet_created_date" date,
"outlet_created_time" time(6),
"outlet_created_by" varchar(255) COLLATE "default",
"outlet_updated_date" date,
"outlet_updated_time" time(6),
"outlet_updated_by" varchar(255) COLLATE "default",
"outlet_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."m_outlet"."outlet_status_aktif" IS 'n = Tidak Aktif, y = Aktif';

-- ----------------------------
-- Records of m_outlet
-- ----------------------------
INSERT INTO "public"."m_outlet" VALUES ('1', 'Outlet 1', 'Jl Basuki Rahmat', '031', 'Surabaya', '-', 'y', '2017-07-27', null, null, '2017-07-27', '23:56:16', 'admin', '6');
INSERT INTO "public"."m_outlet" VALUES ('2', 'Outlet 2', 'Jl MH Tamrin', '031', 'Jakarta', '', 'y', '2017-07-27', '22:41:36', 'admin', '2017-08-01', '05:37:37', 'admin', '18');

-- ----------------------------
-- Table structure for m_pajak
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_pajak";
CREATE TABLE "public"."m_pajak" (
"pajak_id" int4 DEFAULT nextval('m_pajak_pajak_id_seq'::regclass) NOT NULL,
"pajak_nama" varchar(255) COLLATE "default",
"pajak_value" numeric(10,2),
"pajak_outlet" int4 DEFAULT 0,
"pajak_keterangan" varchar(255) COLLATE "default",
"pajak_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"pajak_created_date" date,
"pajak_created_time" time(6),
"pajak_created_by" varchar(255) COLLATE "default",
"pajak_updated_date" date,
"pajak_updated_time" time(6),
"pajak_updated_by" varchar COLLATE "default",
"pajak_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."m_pajak"."pajak_outlet" IS '0 = Semua Outlet, (:num) = Outlet Tertentu';
COMMENT ON COLUMN "public"."m_pajak"."pajak_status_aktif" IS 'n = Tidak Aktif, y = Aktif';

-- ----------------------------
-- Records of m_pajak
-- ----------------------------
INSERT INTO "public"."m_pajak" VALUES ('1', 'PPN', '2.50', '0', '', 'y', '2017-07-28', '00:55:55', 'admin', '2017-07-28', '02:01:32', 'admin', '6');

-- ----------------------------
-- Table structure for m_supplier
-- ----------------------------
DROP TABLE IF EXISTS "public"."m_supplier";
CREATE TABLE "public"."m_supplier" (
"supplier_id" int4 DEFAULT nextval('m_supplier_supplier_id_seq'::regclass) NOT NULL,
"supplier_nama" varchar(255) COLLATE "default",
"supplier_telepon" varchar(255) COLLATE "default",
"supplier_email" varchar(255) COLLATE "default",
"supplier_alamat" varchar(255) COLLATE "default",
"supplier_kota" varchar(255) COLLATE "default",
"supplier_provinsi" varchar(255) COLLATE "default",
"supplier_kodepos" varchar(255) COLLATE "default",
"supplier_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"supplier_created_date" date,
"supplier_created_time" time(6),
"supplier_created_by" varchar(255) COLLATE "default",
"supplier_updated_date" date,
"supplier_updated_time" time(6),
"supplier_updated_by" varchar COLLATE "default",
"supplier_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."m_supplier"."supplier_status_aktif" IS 'n = Tidak, y = Ya';

-- ----------------------------
-- Records of m_supplier
-- ----------------------------
INSERT INTO "public"."m_supplier" VALUES ('1', 'Supplier 1', '031', 'supplier1@gmail.com', 'Jl Basuki Rahmat', 'Surabaya', 'Jawa Timur', '', 'y', '2017-08-06', '21:42:47', 'admin', '2017-08-06', '21:42:59', 'admin', '2');

-- ----------------------------
-- Table structure for s_menu
-- ----------------------------
DROP TABLE IF EXISTS "public"."s_menu";
CREATE TABLE "public"."s_menu" (
"menu_id" int4 DEFAULT nextval('s_menu_menu_id_seq'::regclass) NOT NULL,
"menu_nama" varchar COLLATE "default",
"menu_index" int4,
"menu_type" char(1) COLLATE "default" DEFAULT 0,
"menu_parent" int4 DEFAULT 0,
"menu_idelement" varchar COLLATE "default",
"menu_alias" varchar(255) COLLATE "default",
"menu_link" varchar(255) COLLATE "default",
"menu_color" varchar(255) COLLATE "default",
"menu_icon" varchar(255) COLLATE "default",
"menu_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"menu_created_date" date,
"menu_created_time" time(6),
"menu_created_by" varchar(255) COLLATE "default",
"menu_updated_date" date,
"menu_updated_time" time(6),
"menu_updated_by" varchar COLLATE "default",
"menu_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."s_menu"."menu_type" IS '0 = Mainmenu, 1 = Submenu';
COMMENT ON COLUMN "public"."s_menu"."menu_status_aktif" IS 'n = Tidak Aktif, y = Aktif';

-- ----------------------------
-- Records of s_menu
-- ----------------------------
INSERT INTO "public"."s_menu" VALUES ('1', 'Library', '1', '0', '0', 'library', 'Library', 'Library', '#e74c3c', 'fa fa-book', 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('2', 'Outlet', '1', '1', '1', 'outlet', 'Library', 'Library/Outlet', null, null, 'n', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('3', 'Kategori', '2', '1', '1', 'kategori', 'Library', 'Library/Kategori', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('4', 'Diskon', '4', '1', '1', 'diskon', 'Library/Diskon', 'Library/Diskon', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('5', 'Pajak', '5', '1', '1', 'pajak', 'Library/Pajak', 'Library/Pajak', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('6', 'Gratuity', '6', '1', '1', 'gratuity', 'Library/Gratuity', 'Library/Gratuity', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('7', 'Item', '3', '1', '1', 'item', 'Library/Item', 'Library/Item', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('8', 'Inventory', '2', '0', '0', 'inventory', 'Inventory', 'Inventory', '#34495e', 'fa fa-archive', 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('9', 'Suppliers', '1', '1', '8', 'suppliers', 'Inventory', 'Inventory/Suppliers', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('10', 'Transfer', '2', '1', '8', 'transfer', 'Inventory/Transfer', 'Inventory/Transfer', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('11', 'Adjustment', '3', '1', '8', 'adjustment', 'Inventory/Adjustment', 'Inventory/Adjustment', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('12', 'Customers', '3', '0', '0', 'customers', 'Customers', 'Customers', '#2ecc71', 'fa fa-users', 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('13', 'Customers', '1', '1', '12', 'customers-list', 'Customers', 'Customers/List', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('14', 'Employees', '4', '0', '0', 'employees', 'Employees', 'Employees', '#95a5a6', 'fa fa-id-card-o', 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('15', 'Employees', '2', '1', '14', 'employees-list', 'Employees/List', 'Employees/List', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('16', 'Outlets', '5', '0', '0', 'outlets', 'Outlets', 'Outlets', '#e67e22', 'fa fa-home', 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('17', 'Outlets', '1', '1', '16', 'outlets', 'Outlets', 'Outlets', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('18', 'Employee Type', '1', '1', '14', 'employee-type', 'Employees', 'Employees/Type', null, null, 'y', null, null, null, null, null, null, '0');

-- ----------------------------
-- Table structure for s_privilege
-- ----------------------------
DROP TABLE IF EXISTS "public"."s_privilege";
CREATE TABLE "public"."s_privilege" (
"privilege_id" int4 NOT NULL,
"employee_type_id" int4,
"privilege_create" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"privilege_read" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"privilege_update" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"privilege_delete" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"privilege_status_aktif" char(1) COLLATE "default" DEFAULT 'y'::bpchar,
"privilege_created_date" date,
"privilege_created_time" time(6),
"privilege_created_by" varchar(255) COLLATE "default",
"privilege_updated_date" date,
"privilege_updated_time" time(6),
"privilege_updated_by" varchar COLLATE "default",
"privilege_revised" int4 DEFAULT 0,
"menu_id" int4 DEFAULT nextval('s_privilege_privilege_id_seq'::regclass)
)
WITH (OIDS=FALSE)

;
COMMENT ON COLUMN "public"."s_privilege"."privilege_create" IS 'n = Tidak, y = Ya';
COMMENT ON COLUMN "public"."s_privilege"."privilege_read" IS 'n = Tidak, y = Ya';
COMMENT ON COLUMN "public"."s_privilege"."privilege_update" IS 'n = Tidak, y = Ya';
COMMENT ON COLUMN "public"."s_privilege"."privilege_delete" IS 'n = Tidak, y = Ya';
COMMENT ON COLUMN "public"."s_privilege"."privilege_status_aktif" IS 'n = Tidak Aktif, y = Aktif';

-- ----------------------------
-- Records of s_privilege
-- ----------------------------
INSERT INTO "public"."s_privilege" VALUES ('1', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '1');
INSERT INTO "public"."s_privilege" VALUES ('2', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '2');
INSERT INTO "public"."s_privilege" VALUES ('3', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '3');
INSERT INTO "public"."s_privilege" VALUES ('4', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '4');
INSERT INTO "public"."s_privilege" VALUES ('5', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '5');
INSERT INTO "public"."s_privilege" VALUES ('6', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '6');
INSERT INTO "public"."s_privilege" VALUES ('7', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '7');
INSERT INTO "public"."s_privilege" VALUES ('8', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '8');
INSERT INTO "public"."s_privilege" VALUES ('9', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '9');
INSERT INTO "public"."s_privilege" VALUES ('10', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '10');
INSERT INTO "public"."s_privilege" VALUES ('11', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '11');
INSERT INTO "public"."s_privilege" VALUES ('12', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '12');
INSERT INTO "public"."s_privilege" VALUES ('13', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '13');
INSERT INTO "public"."s_privilege" VALUES ('14', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '14');
INSERT INTO "public"."s_privilege" VALUES ('15', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '15');
INSERT INTO "public"."s_privilege" VALUES ('16', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '16');
INSERT INTO "public"."s_privilege" VALUES ('17', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '17');
INSERT INTO "public"."s_privilege" VALUES ('18', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '18');
INSERT INTO "public"."s_privilege" VALUES ('19', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '19');
INSERT INTO "public"."s_privilege" VALUES ('20', '1', 'y', 'y', 'y', 'y', 'y', null, null, null, null, null, null, '0', '20');

-- ----------------------------
-- Table structure for s_stok
-- ----------------------------
DROP TABLE IF EXISTS "public"."s_stok";
CREATE TABLE "public"."s_stok" (
"stok_id" int4 DEFAULT nextval('s_stok_stok_id_seq'::regclass) NOT NULL,
"outlet_id" int4,
"itemdet_id" int4,
"stok_jumlah" int4,
"stok_created_date" date,
"stok_created_time" time(6),
"stok_created_by" varchar(255) COLLATE "default",
"stok_updated_date" date,
"stok_updated_time" time(6),
"stok_updated_by" varchar(255) COLLATE "default",
"stok_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of s_stok
-- ----------------------------
INSERT INTO "public"."s_stok" VALUES ('1', '1', '7', '60', '2017-08-08', '02:56:51', 'admin', '2017-08-08', '17:49:33', 'admin', '2');
INSERT INTO "public"."s_stok" VALUES ('2', '1', '8', '100', '2017-08-08', '02:56:51', 'admin', '2017-08-08', '17:49:33', 'admin', '1');
INSERT INTO "public"."s_stok" VALUES ('3', '1', '22', '110', '2017-08-08', '02:56:51', 'admin', '2017-08-08', '17:48:20', 'admin', '1');
INSERT INTO "public"."s_stok" VALUES ('5', '2', '7', '60', '2017-08-08', '17:31:08', 'admin', '2017-08-08', '17:48:20', 'admin', '2');
INSERT INTO "public"."s_stok" VALUES ('6', '2', '22', '40', '2017-08-08', '17:48:20', 'admin', '2017-08-08', '17:48:20', 'admin', '0');

-- ----------------------------
-- Table structure for t_adjustment
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_adjustment";
CREATE TABLE "public"."t_adjustment" (
"adjustment_id" int4 DEFAULT nextval('t_adjustment_adjustment_id_seq'::regclass) NOT NULL,
"adjustment_date" date,
"adjustment_time" time(6),
"outlet_id" int4,
"adjustment_keterangan" varchar(255) COLLATE "default",
"adjustment_created_date" date,
"adjustment_created_time" time(6),
"adjustment_created_by" varchar(255) COLLATE "default",
"adjustment_updated_date" date,
"adjustment_updated_time" time(6),
"adjustment_updated_by" varchar(255) COLLATE "default",
"adjustment_revised" int4 DEFAULT 0,
"item_id" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_adjustment
-- ----------------------------
INSERT INTO "public"."t_adjustment" VALUES ('1', '2017-08-08', '02:56:51', '1', '', '2017-08-08', '02:56:51', 'admin', '2017-08-08', '02:56:51', 'admin', '0', '["1","18"]');
INSERT INTO "public"."t_adjustment" VALUES ('2', '2017-08-08', '17:49:32', '1', '', '2017-08-08', '17:49:32', 'admin', '2017-08-08', '17:49:32', 'admin', '0', '["1"]');

-- ----------------------------
-- Table structure for t_adjustmentdet
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_adjustmentdet";
CREATE TABLE "public"."t_adjustmentdet" (
"adjustmentdet_id" int4 DEFAULT nextval('t_adjustmentdet_adjustmentdet_id_seq'::regclass) NOT NULL,
"adjustment_id" int4,
"itemdet_id" int4,
"adjustmentdet_stok_awal" int4,
"adjustmentdet_stok_koreksi" int4,
"adjustmentdet_created_date" date,
"adjustmentdet_created_time" time(6),
"adjustmentdet_created_by" varchar(255) COLLATE "default",
"adjustmentdet_updated_date" date,
"adjustmentdet_updated_time" time(6),
"adjustmentdet_updated_by" varchar(255) COLLATE "default",
"adjustmentdet_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_adjustmentdet
-- ----------------------------
INSERT INTO "public"."t_adjustmentdet" VALUES ('1', '1', '7', '0', '100', '2017-08-08', '02:56:51', 'admin', '2017-08-08', '02:56:51', 'admin', '0');
INSERT INTO "public"."t_adjustmentdet" VALUES ('2', '1', '8', '0', '0', '2017-08-08', '02:56:51', 'admin', '2017-08-08', '02:56:51', 'admin', '0');
INSERT INTO "public"."t_adjustmentdet" VALUES ('3', '1', '22', '0', '150', '2017-08-08', '02:56:51', 'admin', '2017-08-08', '02:56:51', 'admin', '0');
INSERT INTO "public"."t_adjustmentdet" VALUES ('4', '2', '8', '0', '100', '2017-08-08', '17:49:33', 'admin', '2017-08-08', '17:49:33', 'admin', '0');
INSERT INTO "public"."t_adjustmentdet" VALUES ('5', '2', '7', '40', '60', '2017-08-08', '17:49:33', 'admin', '2017-08-08', '17:49:33', 'admin', '0');

-- ----------------------------
-- Table structure for t_penjualan
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_penjualan";
CREATE TABLE "public"."t_penjualan" (
"penjualan_id" int4 NOT NULL,
"outlet_id" int4,
"customer_id" int4,
"penjualan_tanggal" date,
"penjualan_waktu" time(6),
"penjualan_cash" int4,
"penjualan_total" numeric(10,2),
"penjualan_keterangan" varchar(255) COLLATE "default",
"penjualan_created_date" date,
"penjualan_created_time" time(6),
"penjualan_created_by" varchar(255) COLLATE "default",
"penjualan_updated_date" date,
"penjualan_updated_time" time(6),
"penjualan_updated_by" varchar(255) COLLATE "default",
"penjualan_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_penjualan
-- ----------------------------

-- ----------------------------
-- Table structure for t_transfer
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_transfer";
CREATE TABLE "public"."t_transfer" (
"transfer_id" int4 DEFAULT nextval('t_transfer_transfer_id_seq'::regclass) NOT NULL,
"outlet_pengirim_id" int4,
"outlet_penerima_id" int4,
"transfer_tanggal" date,
"transfer_jam" time(6),
"transfer_keterangan" varchar(255) COLLATE "default" DEFAULT ''::character varying,
"transfer_created_date" date,
"transfer_created_time" time(6),
"transfer_created_by" varchar(255) COLLATE "default",
"transfer_updated_date" date,
"transfer_updated_time" time(6),
"transfer_updated_by" varchar(255) COLLATE "default",
"transfer_revised" int4 DEFAULT 0,
"item_id" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_transfer
-- ----------------------------
INSERT INTO "public"."t_transfer" VALUES ('3', '1', '2', '2017-08-08', '17:33:19', '', '2017-08-08', '17:33:19', 'admin', '2017-08-08', '17:33:19', 'admin', '0', '["1"]');
INSERT INTO "public"."t_transfer" VALUES ('4', '1', '2', '2017-08-08', '17:48:20', '-', '2017-08-08', '17:48:20', 'admin', '2017-08-08', '17:48:20', 'admin', '0', '["1","18"]');

-- ----------------------------
-- Table structure for t_transferdet
-- ----------------------------
DROP TABLE IF EXISTS "public"."t_transferdet";
CREATE TABLE "public"."t_transferdet" (
"transferdet_id" int4 DEFAULT nextval('t_transferdet_transferdet_id_seq'::regclass) NOT NULL,
"transfer_id" int4,
"itemdet_id" int4,
"transferdet_stokawal_pengirim" int4,
"transferdet_stokawal_penerima" int4,
"transferdet_quantity" int4,
"transferdet_created_date" date,
"transferdet_created_time" time(6),
"transferdet_created_by" varchar(255) COLLATE "default",
"transferdet_updated_date" date,
"transferdet_updated_time" time(6),
"transferdet_updated_by" varchar(255) COLLATE "default",
"transferdet_revised" int4 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Records of t_transferdet
-- ----------------------------
INSERT INTO "public"."t_transferdet" VALUES ('3', '3', '7', '100', null, '50', '2017-08-08', '17:33:19', 'admin', '2017-08-08', '17:33:19', 'admin', '1');
INSERT INTO "public"."t_transferdet" VALUES ('4', '4', '7', '50', '0', '10', '2017-08-08', '17:48:20', 'admin', '2017-08-08', '17:48:20', 'admin', '2');
INSERT INTO "public"."t_transferdet" VALUES ('5', '4', '22', '150', null, '40', '2017-08-08', '17:48:20', 'admin', '2017-08-08', '17:48:20', 'admin', '0');

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------
ALTER SEQUENCE "public"."m_customer_customer_id_seq" OWNED BY "m_customer"."customer_id";
ALTER SEQUENCE "public"."m_diskon_diskon_id_seq" OWNED BY "m_diskon"."diskon_id";
ALTER SEQUENCE "public"."m_employee_employee_id_seq" OWNED BY "m_employee"."employee_id";
ALTER SEQUENCE "public"."m_employee_type_employee_type_id_seq" OWNED BY "m_employee_type"."employee_type_id";
ALTER SEQUENCE "public"."m_gratuity_gratuity_id_seq" OWNED BY "m_gratuity"."gratuity_id";
ALTER SEQUENCE "public"."m_item_item_id_seq" OWNED BY "m_item"."item_id";
ALTER SEQUENCE "public"."m_itemdet_itemdet_id_seq" OWNED BY "m_itemdet"."itemdet_id";
ALTER SEQUENCE "public"."m_kategori_kategori_id_seq" OWNED BY "m_kategori"."kategori_id";
ALTER SEQUENCE "public"."m_outlet_outlet_id_seq" OWNED BY "m_outlet"."outlet_id";
ALTER SEQUENCE "public"."m_pajak_pajak_id_seq" OWNED BY "m_pajak"."pajak_id";
ALTER SEQUENCE "public"."m_supplier_supplier_id_seq" OWNED BY "m_supplier"."supplier_id";
ALTER SEQUENCE "public"."s_menu_menu_id_seq" OWNED BY "s_menu"."menu_id";
ALTER SEQUENCE "public"."s_privilege_privilege_id_seq" OWNED BY "s_privilege"."privilege_id";
ALTER SEQUENCE "public"."s_stok_stok_id_seq" OWNED BY "s_stok"."stok_id";
ALTER SEQUENCE "public"."t_adjustment_adjustment_id_seq" OWNED BY "t_adjustment"."adjustment_id";
ALTER SEQUENCE "public"."t_adjustmentdet_adjustmentdet_id_seq" OWNED BY "t_adjustmentdet"."adjustmentdet_id";
ALTER SEQUENCE "public"."t_transfer_transfer_id_seq" OWNED BY "t_transfer"."transfer_id";
ALTER SEQUENCE "public"."t_transferdet_transferdet_id_seq" OWNED BY "t_transferdet"."transferdet_id";

-- ----------------------------
-- Primary Key structure for table m_customer
-- ----------------------------
ALTER TABLE "public"."m_customer" ADD PRIMARY KEY ("customer_id");

-- ----------------------------
-- Primary Key structure for table m_diskon
-- ----------------------------
ALTER TABLE "public"."m_diskon" ADD PRIMARY KEY ("diskon_id");

-- ----------------------------
-- Primary Key structure for table m_employee
-- ----------------------------
ALTER TABLE "public"."m_employee" ADD PRIMARY KEY ("employee_id");

-- ----------------------------
-- Primary Key structure for table m_employee_type
-- ----------------------------
ALTER TABLE "public"."m_employee_type" ADD PRIMARY KEY ("employee_type_id");

-- ----------------------------
-- Primary Key structure for table m_gratuity
-- ----------------------------
ALTER TABLE "public"."m_gratuity" ADD PRIMARY KEY ("gratuity_id");

-- ----------------------------
-- Primary Key structure for table m_item
-- ----------------------------
ALTER TABLE "public"."m_item" ADD PRIMARY KEY ("item_id");

-- ----------------------------
-- Primary Key structure for table m_itemdet
-- ----------------------------
ALTER TABLE "public"."m_itemdet" ADD PRIMARY KEY ("itemdet_id");

-- ----------------------------
-- Primary Key structure for table m_kategori
-- ----------------------------
ALTER TABLE "public"."m_kategori" ADD PRIMARY KEY ("kategori_id");

-- ----------------------------
-- Primary Key structure for table m_outlet
-- ----------------------------
ALTER TABLE "public"."m_outlet" ADD PRIMARY KEY ("outlet_id");

-- ----------------------------
-- Primary Key structure for table m_pajak
-- ----------------------------
ALTER TABLE "public"."m_pajak" ADD PRIMARY KEY ("pajak_id");

-- ----------------------------
-- Primary Key structure for table m_supplier
-- ----------------------------
ALTER TABLE "public"."m_supplier" ADD PRIMARY KEY ("supplier_id");

-- ----------------------------
-- Primary Key structure for table s_menu
-- ----------------------------
ALTER TABLE "public"."s_menu" ADD PRIMARY KEY ("menu_id");

-- ----------------------------
-- Primary Key structure for table s_privilege
-- ----------------------------
ALTER TABLE "public"."s_privilege" ADD PRIMARY KEY ("privilege_id");

-- ----------------------------
-- Primary Key structure for table s_stok
-- ----------------------------
ALTER TABLE "public"."s_stok" ADD PRIMARY KEY ("stok_id");

-- ----------------------------
-- Primary Key structure for table t_adjustment
-- ----------------------------
ALTER TABLE "public"."t_adjustment" ADD PRIMARY KEY ("adjustment_id");

-- ----------------------------
-- Primary Key structure for table t_adjustmentdet
-- ----------------------------
ALTER TABLE "public"."t_adjustmentdet" ADD PRIMARY KEY ("adjustmentdet_id");

-- ----------------------------
-- Primary Key structure for table t_penjualan
-- ----------------------------
ALTER TABLE "public"."t_penjualan" ADD PRIMARY KEY ("penjualan_id");

-- ----------------------------
-- Primary Key structure for table t_transfer
-- ----------------------------
ALTER TABLE "public"."t_transfer" ADD PRIMARY KEY ("transfer_id");

-- ----------------------------
-- Primary Key structure for table t_transferdet
-- ----------------------------
ALTER TABLE "public"."t_transferdet" ADD PRIMARY KEY ("transferdet_id");
