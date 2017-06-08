<?php
include_once 'config.php';

// pol_dal tablosuna veri girişi
mysql_query("DELETE FROM pol_dal",$db);
mysql_query("ALTER TABLE pol_dal AUTO_INCREMENT=1",$db);
mysql_query("INSERT INTO pol_dal (pol_ad) VALUES ('İç Hastalıkları') ",$db);
mysql_query("INSERT INTO pol_dal (pol_ad) VALUES ('Ortopedi') ",$db);
mysql_query("INSERT INTO pol_dal (pol_ad) VALUES ('Kalp Damar Cerrahi') ",$db);
mysql_query("INSERT INTO pol_dal (pol_ad) VALUES ('Göz Hastalıkları') ",$db);
mysql_query("INSERT INTO pol_dal (pol_ad) VALUES ('Kulak Burun Boğaz') ",$db);
mysql_query("INSERT INTO pol_dal (pol_ad) VALUES ('Nöroloji') ",$db);
//mysql_query("INSERT INTO pol_dal (pol_ad) VALUES ('Dermatoloji') ",$db);



//ilac tablosuna veri girişi
mysql_query("DELETE FROM ilac",$db);
mysql_query("ALTER TABLE ilac AUTO_INCREMENT=1",$db);
mysql_query("INSERT INTO ilac (ilac_ad,ilac_barkod_no,ilac_miktar,ilac_tipi) 
		VALUES ('Allersol',49873231521,1,'Göz Damlası') ",$db);
mysql_query("INSERT INTO ilac (ilac_ad,ilac_barkod_no,ilac_miktar,ilac_tipi)
		VALUES ('Andolor',87564512341,20,'Tablet') ",$db);
mysql_query("INSERT INTO ilac (ilac_ad,ilac_barkod_no,ilac_miktar,ilac_tipi)
		VALUES ('Asomal',84651538451,1,'Şurup') ",$db);
mysql_query("INSERT INTO ilac (ilac_ad,ilac_barkod_no,ilac_miktar,ilac_tipi)
		VALUES ('Asiviral',54215454154,1,'Krem') ",$db);
mysql_query("INSERT INTO ilac (ilac_ad,ilac_barkod_no,ilac_miktar,ilac_tipi)
		VALUES ('Enflar',12121545488,10,'Tablet') ",$db);
mysql_query("INSERT INTO ilac (ilac_ad,ilac_barkod_no,ilac_miktar,ilac_tipi)
		VALUES ('Ezetrol',21454515184,10,'Tablet') ",$db);
mysql_query("INSERT INTO ilac (ilac_ad,ilac_barkod_no,ilac_miktar,ilac_tipi)
		VALUES ('Naponal',57896415152,12,'Tablet') ",$db);
mysql_query("INSERT INTO ilac (ilac_ad,ilac_barkod_no,ilac_miktar,ilac_tipi)
		VALUES ('Perebron',94512184548,1,'Şurup') ",$db);
mysql_query("INSERT INTO ilac (ilac_ad,ilac_barkod_no,ilac_miktar,ilac_tipi)
		VALUES ('Zovirax',87415123333,1,'Krem') ",$db);
mysql_query("INSERT INTO ilac (ilac_ad,ilac_barkod_no,ilac_miktar,ilac_tipi)
		VALUES ('Rinizol',95454852224,1,'Burun Spreyi') ",$db);


//doktor tablosuna veri girişi
mysql_query("DELETE FROM doktor",$db);
mysql_query("ALTER TABLE doktor AUTO_INCREMENT=1",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Mustafa','Albayrak',1) ",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Merve','Koç',2) ",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Cem','Saygın',3) ",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Gonca','Akın',4) ",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Cüneyt','Şaşmaz',5) ",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Gözde','Yılmaz',6) ",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Murat','Saygılı',1) ",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Yunus Emre','Erken',2) ",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Emre','Kara',3) ",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Mehmet','Kaya',4) ",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Veli','Boyacı',5) ",$db);
mysql_query("INSERT INTO doktor (dr_ad,dr_soyad,dr_dal_no)
		VALUES ('Mahmut','Arslan',6) ",$db);


//stok tablosuna veri girişi
mysql_query("DELETE FROM stok",$db);
mysql_query("ALTER TABLE stok AUTO_INCREMENT=1",$db);
mysql_query("INSERT INTO stok (mal_ad,stok_adet,mal_fiyat)
		VALUES ('Sargı Bezi',5000,2.5) ",$db);
mysql_query("INSERT INTO stok (mal_ad,stok_adet,mal_fiyat)
		VALUES ('Şırınga',2500,1.25) ",$db);
mysql_query("INSERT INTO stok (mal_ad,stok_adet,mal_fiyat)
		VALUES ('Serum',2000,10) ",$db);
mysql_query("INSERT INTO stok (mal_ad,stok_adet,mal_fiyat)
		VALUES ('Plaster',3000,4.75) ",$db);






?>