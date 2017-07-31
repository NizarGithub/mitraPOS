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

Date: 2017-08-01 05:38:28
*/


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
 START 22
 CACHE 1;
SELECT setval('"public"."m_itemdet_itemdet_id_seq"', 22, true);

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
-- Sequence structure for s_menu_menu_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."s_menu_menu_id_seq";
CREATE SEQUENCE "public"."s_menu_menu_id_seq"
 INCREMENT 1
 MINVALUE 1
 MAXVALUE 9223372036854775807
 START 7
 CACHE 1;
SELECT setval('"public"."s_menu_menu_id_seq"', 7, true);

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
INSERT INTO "public"."m_employee_type" VALUES ('1', 'Administrator', '-', 'y', null, null, null, null, null, null, '0');

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
INSERT INTO "public"."m_item" VALUES ('2', 'Bakso', '0', '0', '', 'y', '2017-08-01', '03:56:24', 'admin', '2017-08-01', '04:39:10', 'admin', '3');
INSERT INTO "public"."m_item" VALUES ('3', 'Item 1', '0', '0', '', 'y', '2017-08-01', '04:40:15', 'admin', '2017-08-01', '04:46:38', 'admin', '1');
INSERT INTO "public"."m_item" VALUES ('18', 'Item 2', '0', '0', '', 'y', '2017-08-01', '05:24:52', 'admin', '2017-08-01', '05:25:42', 'admin', '1');

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
INSERT INTO "public"."m_itemdet" VALUES ('9', 'Jenggot', '2', '10000', '-', 'y', 'y', '10', 'y', '2017-08-01', '04:39:10', 'admin', '2017-08-01', '04:39:10', 'admin', '0');
INSERT INTO "public"."m_itemdet" VALUES ('10', 'Sapi', '2', '10000', '-', 'y', 'y', '10', 'y', '2017-08-01', '04:39:10', 'admin', '2017-08-01', '04:39:10', 'admin', '0');
INSERT INTO "public"."m_itemdet" VALUES ('12', null, '3', '12000', '-', 'n', 'n', '10', 'y', '2017-08-01', '04:46:38', 'admin', '2017-08-01', '04:46:38', 'admin', '0');
INSERT INTO "public"."m_itemdet" VALUES ('22', null, '18', '12000', '-', 'y', 'y', '10', 'y', '2017-08-01', '05:25:42', 'admin', '2017-08-01', '05:25:42', 'admin', '0');

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
INSERT INTO "public"."s_menu" VALUES ('1', 'Library', '1', '0', '0', 'library', 'Library', 'Library', 'bg-red-sunglo', 'fa fa-book', 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('2', 'Outlet', '1', '1', '1', 'outlet', 'Library', 'Library/Outlet', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('3', 'Kategori', '2', '1', '1', 'kategori', 'Library/Kategori', 'Library/Kategori', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('4', 'Diskon', '4', '1', '1', 'diskon', 'Library/Diskon', 'Library/Diskon', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('5', 'Pajak', '5', '1', '1', 'pajak', 'Library/Pajak', 'Library/Pajak', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('6', 'Gratuity', '6', '1', '1', 'gratuity', 'Library/Gratuity', 'Library/Gratuity', null, null, 'y', null, null, null, null, null, null, '0');
INSERT INTO "public"."s_menu" VALUES ('7', 'Item', '3', '1', '1', 'item', 'Library/Item', 'Library/Item', null, null, 'y', null, null, null, null, null, null, '0');

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
-- Alter Sequences Owned By 
-- ----------------------------
ALTER SEQUENCE "public"."m_diskon_diskon_id_seq" OWNED BY "m_diskon"."diskon_id";
ALTER SEQUENCE "public"."m_employee_employee_id_seq" OWNED BY "m_employee"."employee_id";
ALTER SEQUENCE "public"."m_employee_type_employee_type_id_seq" OWNED BY "m_employee_type"."employee_type_id";
ALTER SEQUENCE "public"."m_gratuity_gratuity_id_seq" OWNED BY "m_gratuity"."gratuity_id";
ALTER SEQUENCE "public"."m_item_item_id_seq" OWNED BY "m_item"."item_id";
ALTER SEQUENCE "public"."m_itemdet_itemdet_id_seq" OWNED BY "m_itemdet"."itemdet_id";
ALTER SEQUENCE "public"."m_kategori_kategori_id_seq" OWNED BY "m_kategori"."kategori_id";
ALTER SEQUENCE "public"."m_outlet_outlet_id_seq" OWNED BY "m_outlet"."outlet_id";
ALTER SEQUENCE "public"."m_pajak_pajak_id_seq" OWNED BY "m_pajak"."pajak_id";
ALTER SEQUENCE "public"."s_menu_menu_id_seq" OWNED BY "s_menu"."menu_id";
ALTER SEQUENCE "public"."s_privilege_privilege_id_seq" OWNED BY "s_privilege"."privilege_id";

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
-- Primary Key structure for table s_menu
-- ----------------------------
ALTER TABLE "public"."s_menu" ADD PRIMARY KEY ("menu_id");

-- ----------------------------
-- Primary Key structure for table s_privilege
-- ----------------------------
ALTER TABLE "public"."s_privilege" ADD PRIMARY KEY ("privilege_id");
