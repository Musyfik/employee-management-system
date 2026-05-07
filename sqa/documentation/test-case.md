# Employee Management System - Test Case

## Authentication

| ID | Scenario | Steps | Expected Result | Status |
|----|----------|-------|----------------|--------|
| TC001 | Login dengan data valid | Input email dan password benar | User berhasil login | Pass |
| TC002 | Login password salah | Input password salah | Muncul error invalid credential | Pass |
| TC003 | Login email kosong | Kosongkan email | Validasi email required muncul | Pass |
| TC004 | Logout system | Klik tombol logout | User keluar dari sistem | Pass |

---

## Employee CRUD

| ID | Scenario | Steps | Expected Result | Status |
|----|----------|-------|----------------|--------|
| TC005 | Tambah employee valid | Isi semua field valid | Employee berhasil ditambah | Fail |
| TC006 | Nama kosong | Kosongkan nama | Validasi nama muncul | Pass |
| TC007 | Upload foto valid | Upload file image | Foto berhasil upload | Fail |
| TC008 | Delete employee | Klik delete employee | Employee berhasil dihapus | Pass |

---

## Search & Filter

| ID | Scenario | Steps | Expected Result | Status |
|----|----------|-------|----------------|--------|
| TC009 | Search employee | Cari nama employee | Data tampil sesuai keyword | Pass |
| TC010 | Filter division | Pilih division | Data sesuai division | Pass |