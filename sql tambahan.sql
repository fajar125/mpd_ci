CREATE TABLE sikp.permissions (
    permission_id integer NOT NULL,
    permission_name character varying(100) NOT NULL,
    permission_display_name character varying(255),
    permission_description character varying(255),
    created_by character varying(25),
    created_date date,
    updated_by character varying(25),
    updated_date date
);

CREATE TABLE sikp.permission_role (
    p_app_role_id integer,
    permission_id integer,
    created_by character varying(25),
    created_date date,
    updated_by character varying(25),
    updated_date date
);

CREATE TABLE sikp.permission_menu (
    p_app_menu_id integer,
    permission_id integer,
    created_by character varying(25),
    created_date date,
    updated_by character varying(25),
    updated_date date
);

CREATE TABLE sikp.logs (
    log_id integer NOT NULL,
    log_desc character varying(255) NOT NULL,
    log_user character varying(25),
    created_by character varying(25),
    created_date date,
    updated_by character varying(25),
    updated_date date
);

insert into sikp.permissions 
(permission_id, permission_name, permission_display_name, permission_description, created_by, created_date, updated_by, updated_date) values
(1,	'can-view-user','','','admin','2017-05-29','admin',	'2017-05-29');

insert into sikp.permission_role 
(p_app_role_id, permission_id, created_by, creation_date, updated_by, updated_date) values
(1,	1,	'admin',	'2017-05-29',	'admin',	'2017-05-29');

ALTER TABLE sikp.p_application
  ADD COLUMN module_icon character varying(100);
  
ALTER TABLE sikp.p_application
  ADD COLUMN is_active character varying(1);

UPDATE sikp.p_application SET module_icon='images/md_01_on.png';

UPDATE sikp.p_application set is_active ='Y';

UPDATE sikp.p_app_user SET p_user_status_id =1 where p_app_user_id=1;

UPDATE "sikp"."p_app_menu" SET "file_name"='administration.p_application' WHERE ("p_app_menu_id"='7');
UPDATE "sikp"."p_app_menu" SET "file_name"='administration.p_app_user' WHERE ("p_app_menu_id"='8');
UPDATE "sikp"."p_app_menu" SET "file_name"='administration.p_app_role' WHERE ("p_app_menu_id"='6');

--tambahan di global param untuk logo, nama dan alamat instansi

INSERT INTO "sikp"."p_global_param" ("p_global_param_id", "code", "value", "type_1", "is_range", "description", "creation_date", "created_by", "updated_date", "updated_by") VALUES (generate_id('sikp', 'p_global_param', 'p_global_param_id'), 'ALAMAT_1', 'Jalan Wastukancana No.2', 'N', 'N', 'ALAMAT PEMKOT LOMBOK', '2017-09-25 16:39:29', 'ADMIN', '2017-09-25 16:39:36', 'ADMIN');

INSERT INTO "sikp"."p_global_param" ("p_global_param_id", "code", "value", "type_1", "is_range", "description", "creation_date", "created_by", "updated_date", "updated_by") VALUES (generate_id('sikp', 'p_global_param', 'p_global_param_id'), 'ALAMAT_2', 'Telp. 022-4235052 - Lombok Utara', 'N', 'N', 'ALAMAT PEMKOT LOMBOK', '2017-09-25 16:39:29', 'ADMIN', '2017-09-25 16:39:36', 'ADMIN');

INSERT INTO "sikp"."p_global_param" ("p_global_param_id", "code", "value", "type_1", "is_range", "description", "creation_date", "created_by", "updated_date", "updated_by") VALUES (generate_id('sikp', 'p_global_param', 'p_global_param_id'), 'ALAMAT_3', 'Lombok Utara', 'N', 'N', 'ALAMAT PEMKOT LOMBOK', '2017-09-25 16:39:29', 'ADMIN', '2017-09-25 16:39:36', 'ADMIN');

INSERT INTO "sikp"."p_global_param" ("p_global_param_id", "code", "value", "type_1", "is_range", "description", "creation_date", "created_by", "updated_date", "updated_by") VALUES (generate_id('sikp', 'p_global_param', 'p_global_param_id'), 'LOGO', 'images/logo_lombok.png', 'N', 'N', 'LOGO PEMKOT LOMBOK', '2017-09-25 16:39:29', 'ADMIN', '2017-09-25 16:39:36', 'ADMIN');

INSERT INTO "sikp"."p_global_param" ("p_global_param_id", "code", "value", "type_1", "is_range", "description", "creation_date", "created_by", "updated_date", "updated_by") VALUES (generate_id('sikp', 'p_global_param', 'p_global_param_id'), 'INSTANSI_1', 'PEMERINTAH KABUPATEN LOMBOK UTARA', 'N', 'N', 'NAMA PEMKOT LOMBOK', '2017-09-25 16:39:29', 'ADMIN', '2017-09-25 16:39:36', 'ADMIN');

INSERT INTO "sikp"."p_global_param" ("p_global_param_id", "code", "value", "type_1", "is_range", "description", "creation_date", "created_by", "updated_date", "updated_by") VALUES (generate_id('sikp', 'p_global_param', 'p_global_param_id'), 'INSTANSI_2', 'BADAN PENGELOLAAN PENDAPATAN DAERAH', 'N', 'N', 'NAMA PEMKOT LOMBOK', '2017-09-25 16:39:29', 'ADMIN', '2017-09-25 16:39:36', 'ADMIN');