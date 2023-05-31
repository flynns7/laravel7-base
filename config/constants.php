<?php
//Sample Constant

$listEnv = [
    "local-h" => "localhost:8000/",
    "local" => "http://10.16.4.4/",
    "production" => "http://172.16.20.4/api-app-sippd/",
];

defined('OPTION_ATTACHMENT')                or define('OPTION_ATTACHMENT', 13);
defined('OPTION_EMAIL')                     or define('OPTION_EMAIL', 14);
defined('OPTION_MONETERY')                  or define('OPTION_MONETERY', 15);
defined('OPTION_RATINGS')                   or define('OPTION_RATINGS', 16);
defined('OPTION_TEXTAREA')                  or define('OPTION_TEXTAREA', 17);
defined('API_URL')                          or define('API_URL', $listEnv[config('app.env')]);
defined('API_CREDENTIAL')                   or define('API_CREDENTIAL', 'apiCredential');
defined('PATH_PATDA_P_PAJAK')               or define('PATH_PATDA_P_PAJAK', "patda.pelayanan.pelaporan_pajak.");
defined('PATH_PATDA_P_K_BERKAS')            or define('PATH_PATDA_P_K_BERKAS', "patda.pelayanan.kelengkapan_berkas.");
defined('PATH_PATDA_P_C_SURAT')             or define('PATH_PATDA_P_C_SURAT', "patda.pelayanan.cetak_surat.");
defined('PATH_PATDA_P_VERIFIKASI')          or define('PATH_PATDA_P_VERIFIKASI', "patda.pelayanan.verifikasi_pajak.");
defined('PATH_PATDA_MONITORING')            or define('PATH_PATDA_MONITORING', "patda.monitoring.");
defined('PATH_PATDA_PEMBAYARAN')            or define('PATH_PATDA_PEMBAYARAN', "patda.pembayaran.");
defined('PATH_PATDA_ADMIN')                 or define('PATH_PATDA_ADMIN', "patda.admin.");
defined('PATH_PATDA_MD')                    or define('PATH_PATDA_MD', "patda.master_data.");
defined('PATH_PATDA_PENAGIHAN_PENETAPAN')   or define('PATH_PATDA_PENAGIHAN_PENETAPAN', "patda.penagihan_dan_penetapan.");
defined('PATH_PBB_P_LOKET')                 or define('PATH_PBB_P_LOKET', "pbb.pelayanan.loket_pelayanan.");
defined('PATH_PBB_P_KOOR')                  or define('PATH_PBB_P_KOOR', "pbb.pelayanan.koordinator_pelayanan.");
defined('PATH_PBB_P_STAFF')                 or define('PATH_PBB_P_STAFF', "pbb.pelayanan.staff_pelayanan.");
defined('PATH_PBB_P_VERIF')                 or define('PATH_PBB_P_VERIF', "pbb.pelayanan.verifikasi_pelayanan.");
defined('PATH_PBB_P_SET')                   or define('PATH_PBB_P_SET', "pbb.pelayanan.persetujuan_pelayanan.");
defined('PATH_PBB_P_POP')                   or define('PATH_PBB_P_POP', "pbb.pendataan.pengelolaan_objek_pajak.");
defined('PATH_PBB_P_VER1')                  or define('PATH_PBB_P_VER1', "pbb.pendataan.verifikasi1.");
defined('PATH_PBB_P_VERKEB')                or define('PATH_PBB_P_VERKEB', "pbb.pendataan.verifikasi_keberatan.");
defined('PATH_PBB_P_VERMUT')                or define('PATH_PBB_P_VERMUT', "pbb.pendataan.verifikasi_mutasi.");
defined('PATH_PBB_P_VERPGR')                or define('PATH_PBB_P_VERPGR', "pbb.pendataan.verifikasi_pengurangan.");
defined('PATH_PBB_PENILAIAN')               or define('PATH_PBB_PENILAIAN', "pbb.penilaian.");
defined('PATH_PBB_PENETAPAN')               or define('PATH_PBB_PENETAPAN', "pbb.penetapan.");
defined('PATH_PBB_KONFIGURASI')             or define('PATH_PBB_KONFIGURASI', "pbb.konfigurasi_aplikasi.");
defined('PATH_PBB_MASTER_DATA')             or define('PATH_PBB_MASTER_DATA', "pbb.master_data.");
defined('PATH_PBB_MONITORING')              or define('PATH_PBB_MONITORING', "pbb.monitoring.");
defined('STATUS_PENDING')                   or define('STATUS_PENDING', "0");
defined('STATUS_APPROVE')                   or define('STATUS_APPROVE', "1");
defined('STATUS_RETURN')                    or define('STATUS_RETURN', "2");
defined('STATUS_REJECT')                    or define('STATUS_REJECT', "3");
defined('WF_ID')                            or define('WF_ID', "20");
defined('WF_ID_PENGURANGAN')                or define('WF_ID_PENGURANGAN', "24");
defined('WFV_ID')                           or define('WFV_ID', "23");
defined('WFV_ID_PENGURANGAN')               or define('WFV_ID_PENGURANGAN', "27");
defined('PUBLIC_IP')                        or define('PUBLIC_IP', "http://203.128.88.230:8080/");
// defined('PUBLIC_IP')                        or define('PUBLIC_IP', $_SERVER['SERVER_ADDR']);
defined('UNREKLAME')                        or define('UNREKLAME', "bapenda");
defined('PWREKLAME')                        or define('PWREKLAME', "4p1reklam3");
defined('URL_API_REKLAME')                  or define('URL_API_REKLAME', "https://olsdpmptsp.bandung.go.id/");
defined('DOC_SK_ANGSURAN')                  or define('DOC_SK_ANGSURAN', "1");
defined('DOC_SK_KOMPENSASI')                or define('DOC_SK_KOMPENSASI', "4");
defined('BAP_BPHTB_PENGURANGAN')            or define('BAP_BPHTB_PENGURANGAN', "027");
defined('GENERATE_FILE_MENU')               or define('GENERATE_FILE_MENU', "1");
defined('LIMIT_EXPORT_DATA')                or define('LIMIT_EXPORT_DATA', 10000);
