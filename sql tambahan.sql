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

CREATE OR REPLACE FUNCTION sikp.f_payment_manual_paymentkey_v3(
    i_customer_order_id numeric,
    i_user_name character varying,
    i_payment_type_id numeric,
    OUT o_cust_order_id numeric,
    OUT o_mess character varying)
  RETURNS record AS
$BODY$

declare
    ln_x  numeric(5);
    ln_month numeric(2);
    ln_fin_period_id numeric(8);
    ln_cust_acc_id   numeric(10);
    ls_vat_code varchar(64);
    ls_period_code  varchar(1000);
    ls_company_name varchar(128);
    ls_company_brand varchar(128);
    ln_pay_rec_id   numeric(12);
    ls_receipt_no   varchar(128);
    ln_vat_setlement_id numeric(10);
    ls_bit_48       Varchar2(3000);
    ls_receipt_print Varchar2(3000);
    ls_coa_code      Varchar2(32);
    ls_vat_setlement_id Varchar2(32);
    ls_sms_return    Varchar2(4000);
    ls_no_hp         varchar2(80);
    ldt_start_date   date;
    ln_count         Number(10);
    ldt_payment_date date;
    ln_p_vat_type_dtl_id number(5);
    ln_penalty_amt   Number(16,2);
    lnx_p_vat_type_dtl_id number(5);
    ls_npwd          Varchar2(32);
    ln_vat_amt   Number(16,2);
    ln_payment_amount Number(16,2);
    ls_payment_amount Varchar2(64);
    o_ret_code        Varchar2(500);
    ls_no_kohir       Varchar2(32);
BEGIN
	o_cust_order_id :=0;
    Select a.t_vat_setllement_id  ,
           nvl(x.penalty_amt,0) ,
           a.p_vat_type_dtl_id ,
           a.npwd ,
           a.payment_key,
           nvl(b.kode_jns_pjk||'.'||b.type_ayat,'-'),
           a.t_cust_account_id,
           nvl(a.total_vat_amount,0) ,
           a.p_finance_period_id
    Into ln_vat_setlement_id ,
         ln_penalty_amt,
         lnx_p_vat_type_dtl_id ,
         ls_npwd,
         ls_no_kohir,
         ls_coa_code,
         ln_cust_acc_id,
         ln_vat_amt,
         ln_fin_period_id
    From t_vat_setllement a, v_p_vat_type_dtl_rep  b, t_vat_penalty x
    Where t_customer_order_id = i_customer_order_id
          and a.p_vat_type_dtl_id = b.p_vat_type_dtl_id (+)
          and a.t_vat_setllement_id =  x.t_vat_setllement_id (+)
          ;

    select count(*) into ln_count
    from t_payment_receipt
    where t_vat_setllement_id = ln_vat_setlement_id ;

    if ln_count > 0 then
       o_mess := 'Proses dibatalkan. Flag Pembayaran sudah pernah dilakukan.';
       o_cust_order_id:=0;
       return;
    end if;

    begin
       select code into ls_period_code
       from p_finance_period
       where p_finance_period_id = ln_fin_period_id ;
       exception
          when others then
             ls_period_code := '-';
    end;

    ln_payment_amount := ln_vat_amt + ln_penalty_amt;
    ls_payment_amount := trim(to_char(ln_payment_amount,'999,999,999,999,999.99'));
    --start payment
    Begin
             select t_payment_receipt_seq.nextval into ln_pay_rec_id from dual;
             ldt_payment_date := sysdate;
             --ls_receipt_no := to_char(ldt_payment_date,'yyyymmdd-hh24:mi:ss')||'-'||ls_payment_amount||'-'||ls_coa_code ||'-'||ls_npwd||'-'||ls_no_kohir;--lpad(to_char(ln_pay_rec_id),12,'0');
             ls_receipt_no := 'M-'||lpad(to_char(ln_pay_rec_id),9,'0')||'-'||to_char(ldt_payment_date,'yyyymmdd');
             --o_ret_code := ls_receipt_no ;
             --return;
             ldt_payment_date := sysdate;
	     insert into t_payment_receipt
	         (t_payment_receipt_id,
                  receipt_no          ,
                  payment_date        ,
                  t_cust_account_id   ,
                  p_cg_terminal_id    ,
                  product_code        ,
                  npwd                ,
                  payment_amount      ,
                  payment_vat_amount  ,
                  t_vat_setllement_id ,
                  p_finance_period_id ,
                  finance_period_code ,
                  trace_no ,
                  penalty_amount,
                  p_vat_type_dtl_id,
                  p_payment_type_id,
                  kode_cabang,
                  kode_bank
	         )
	      values
	         (ln_pay_rec_id ,
                  ls_receipt_no,
                  ldt_payment_date,
                  ln_cust_acc_id,
                  substr(i_user_name,1,32),
                  ls_coa_code,
                  ls_npwd,
                  ln_payment_amount,
                  ln_vat_amt,
                  ln_vat_setlement_id,
                  ln_fin_period_id,
                  ls_period_code,
                  to_char(ln_pay_rec_id) ,
                  ln_penalty_amt,
                  lnx_p_vat_type_dtl_id,
                  i_payment_type_id,
                  '0000',
                  '0000'
	         );

	     update t_vat_setllement
	     set is_settled = 'Y'
	     where t_vat_setllement_id = ln_vat_setlement_id;

	     --commit;
		BEGIN
				select trim(t_cust_account.mobile_no) into ls_no_hp from t_cust_account where t_cust_account_id = ln_cust_acc_id;
		EXCEPTION
				when OTHERS then
				ls_no_hp = null;
		end;
	  if length(ls_no_hp) > 6 then
	     --Disyanjak Kota Bandung Terimakasih atas pembayaran pajak hotel sebesar Rp xxxx pada dd-mm-yyyy hh24:mi:ss dengan nomer ref: xxxxxxx www.disyanjak.bandung.go.id
	     --select f_send_sms(ls_no_hp,'Disyanjak Kota Bandung : Terimakasih atas pembayaran '||||' sebesar Rp '||to_char(i_payment_amount)||' pada '||to_char(ldt_payment_date,'dd-mm-yyyy hh24:mi:ss') ||' dengan nomor ref '||  ls_receipt_no||'.  www.disyanjak.bandung.go.id')   into ls_sms_return;
	     --select f_send_sms(ls_no_hp,'Terikasih atas pembayaran pajak anda sebesar Rp. '||to_char(i_payment_amount))   into ls_sms_return;
				--select f_send_sms_new(ls_npwd,ls_no_hp,'Disyanjak Kota Bandung : Terimakasih atas pembayaran '||||' sebesar Rp '||to_char(i_payment_amount)||' pada '||to_char(ldt_payment_date,'dd-mm-yyyy hh24:mi:ss') ||' dengan nomor ref '||  ls_receipt_no||'.  www.disyanjak.bandung.go.id')into ls_sms_return;
			INSERT INTO t_sms_outbox(
							npwpd,
							mobile_no,
							message,
							is_sent,
							date_added,
							message_type)
			VALUES (ls_npwd,
							ls_no_hp,
							'Terimakasih atas pembayaran Pajak Daerah Anda'||' sebesar Rp '||to_char(ls_payment_amount)||' pada '||to_char(ldt_payment_date,'dd-mm-yyyy hh24:mi:ss') ||' dengan nomor bayar '||  ls_no_kohir||'. BANDUNG JUARA',
							'N',
							sysdate,
							'IMMIDIATEDLY');
			--NULL;
		end if;
	  exception
	    when no_data_found then
	        o_mess :='Flag Pembayaran Gagal dengan pesan :'||sqlerrm;
	        o_cust_order_id := 0;
                Return ;--o_ret_code;
     End ;

      o_mess := 'Flag Pembayaran Berhasil.';
      o_cust_order_id := i_customer_order_id;
      exception
        when OTHERS then
           o_mess  :='Pembayaran Gagal dengan pesan -:'||sqlerrm;
           o_cust_order_id := 0;
           --o_ret_code;
           Return ;
   End;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;


INSERT INTO "sikp"."p_global_param" ("p_global_param_id", "code", "value", "type_1", "is_range", "value_2", "description", "creation_date", "created_by", "updated_date", "updated_by")
VALUES (generate_id('sikp', 'p_global_param', 'p_global_param_id'), 'LIMIT_NIHIL_RESTORAN', '10000000', 'V', 'N', 'Y', 'pengecekkan di fungsi f_vat_settlement_manual_wp', '2017-09-12 00:00:00', 'ADMIN', '2017-09-12 00:00:00', 'ADMIN');

update p_app_menu
set file_name = replace('parameter.' || substr(file_name,7),'.php','')
where file_name like 'param/%';

update p_app_menu
set file_name = replace('transaksi.' || substr(file_name,7),'.php','')
where file_name like 'trans/%';

update  p_app_menu
set file_name = 'data_master.t_customer'
where file_name like 'parameter.t_customer';

update p_app_menu
set file_name = 'pelaporan.' || substr(file_name,11)
where file_name in(
'transaksi.t_laporan_history_potensi_piutang_tgl_tap',
'transaksi.t_laporan_posisi_surat_teguran',
'transaksi.t_rep_bpps2',
'transaksi.t_rep_lap_harian',
'transaksi.t_rep_lap_harian_bdhr',
'transaksi.t_target_realisasi',
'transaksi.t_target_realisasi_bidang',
'transaksi.t_target_realisasi_jenis',
'transaksi.t_target_realisasi_jenis_bulan');
