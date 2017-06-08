<?php 
include_once 'config.php';
include_once 'functions.php';

print getHeader("Hasta Görüntüle");
?>


    <div class="page-content">
    	<div class="row">
		  <div class="col-md-2">
		  	<div class="sidebar content-box" style="display: block;">
<!-- MENU >> -->                <?php print getMenu();?>
             </div>
		  </div>
		  
		  <div class="col-md-10">
		  
		  	<div class="row">
		  		
		  	<div class="content-box-large">
				<div class="panel-heading">
					<div class="panel-title">Kayıtlı Hastalar</div>
				</div>
				<div class="panel-body">
					<div id="example_wrapper" class="dataTables_wrapper form-inline"
						role="grid">
						<table aria-describedby="example_info"
							class="table table-striped table-bordered dataTable" id="example"
							border="0" cellpadding="0" cellspacing="0">
							<thead>
								<tr role="row">
									
									<th	aria-label="Rendering engine: activate to sort column descending"
										aria-sort="ascending" style="width: 35px;" colspan="1"
										rowspan="1" aria-controls="example" tabindex="0"
										role="columnheader" class="sorting_asc">ID</th>
									<th aria-label="Browser: activate to sort column ascending"
										style="width: 90px;" colspan="1" rowspan="1"
										aria-controls="example" tabindex="0" role="columnheader"
										class="sorting">Ad</th>
										<th aria-label="Browser: activate to sort column ascending"
										style="width: 99px;" colspan="1" rowspan="1"
										aria-controls="example" tabindex="0" role="columnheader"
										class="sorting">Soyad</th>
									<th aria-label="Platform(s): activate to sort column ascending"
										style="width: 120px;" colspan="1" rowspan="1"
										aria-controls="example" tabindex="0" role="columnheader"
										class="sorting">Poliklinik</th>
									<th
										aria-label="Engine version: activate to sort column ascending"
										style="width: 99px;" colspan="1" rowspan="1"
										aria-controls="example" tabindex="0" role="columnheader"
										class="sorting">Doktor</th>
										<th
										aria-label="Engine version: activate to sort column ascending"
										style="width: 100px;" colspan="1" rowspan="1"
										aria-controls="example" tabindex="0" role="columnheader"
										class="sorting">Tanı</th>
									<th aria-label="CSS grade: activate to sort column ascending"
										style="width: 100px;" colspan="1" rowspan="1"
										aria-controls="example" tabindex="0" role="columnheader"
										class="sorting">Kayıt Tarihi</th>
									<th aria-label="CSS grade: activate to sort column ascending"
										style="width: 10px;" colspan="1" rowspan="1"
										aria-controls="example" tabindex="0" role="columnheader"
										class="sorting">#</th>
								</tr>
							</thead>

							<tbody aria-relevant="all" aria-live="polite" role="alert">
		 		<?php
			$num_rec_per_page = 10;
			if (isset ( $_GET ["page"] )) {
				$page = $_GET ["page"];
			} else {
				$page = 1;
			}
			if($page<=0)
				$page=1;
			$start_from = ($page - 1) * $num_rec_per_page;
			
			
			$sql = "SELECT * FROM pol_kayit LIMIT $start_from, $num_rec_per_page";
			$rs_result = mysql_query ( $sql ); // run the query
			while ( $row = mysql_fetch_assoc ( $rs_result ) ) {
				
				
				
				$sqlHasta="SELECT * FROM hasta WHERE kayit_no={$row['kayit_no']}";//hastanın adı ve soyadını çekmek için
				$rsHasta=mysql_query($sqlHasta,$db);
				echo '<tr class="gradeA odd"> 
									<td class="  sorting_1"><strong>'.$row['kayit_no'].'</strong> <a  title="Bunun için yetkiniz yok">Detay <i class="glyphicon glyphicon-search"></i> </td>';

				
				while ($row2=mysql_fetch_assoc($rsHasta)) {
					echo '	<td class=" ">'.$row2['h_ad'].'</a></td>
							<td class=" ">'.$row2['h_soyad'].'</td>';
				}
				$sqlPoliklinik="SELECT * FROM pol_dal WHERE pol_no={$row['pol_no']} ";
				$rsPol=mysql_query($sqlPoliklinik,$db);//poliklinik adını çekmek için..bitmedi
				while ($row3=mysql_fetch_assoc($rsPol)) {
					echo '<td class="center ">'.$row3['pol_ad'].'</td>';
				}
				
				$sqlDoktor="SELECT * FROM doktor WHERE dr_no={$row['dr_no']} ";
				$rsDoktor=mysql_query($sqlDoktor,$db);//poliklinik adını çekmek için..bitmedi
				while ($row4=mysql_fetch_assoc($rsDoktor)) {
					echo '<td class="center ">'.$row4['dr_ad'].' '.$row4['dr_soyad'].'</td>';
				}
				
				
				echo '
									<td class="center ">'.$row['tani'].'</td>
									<td class="center ">'.$row['h_kayit_tarihi'].'</td>';
									if($row['h_cikis_tarihi']==null){
										echo '<td class="center" style="background-color: green;"></td>';}
									else{
										echo '<td class="center" style="background-color: red;"></td>';}
									echo '</tr>';
				
				
			}
			
			
			
			
			;
			$sql = "SELECT * FROM pol_kayit";
			$rs_result = mysql_query ( $sql ); // run the query
			$total_records = mysql_num_rows ( $rs_result ); // count number of records
			$total_pages = ceil ( $total_records / $num_rec_per_page );
			
			
?>
</tbody>
						</table>
						<div class="row">
							<div class="col-xs-3">
								<div class="dataTables_info">Showing [
								<?php 
								if(($num_rec_per_page+$start_from)>$total_records){
									echo ($start_from+1).'-'.$total_records.'] / '.$total_records;
								}else{
								echo ($start_from+1).'-'.($num_rec_per_page+$start_from).'] / '.$total_records; }
								?> entries</div>
							</div>
							<div class="col-xs-6" align="left">
								<div class="dataTables_paginate paging_bootstrap">
									<ul class="pagination">
		<?php
			$sql = "SELECT * FROM pol_kayit";
			$rs_result = mysql_query ( $sql ); // run the query
			$total_records = mysql_num_rows ( $rs_result ); // count number of records
			$total_pages = ceil ( $total_records / $num_rec_per_page );
			echo "<li><a href='hastaGoruntule.php?page=1'>" . 'Başa dön ' . "</a> </li>"; // Goto 1st page
			
			for($i = 1; $i <= $total_pages; $i ++) {
				echo "<li><a href='hastaGoruntule.php?page=" . $i . "'>" . $i . " </a></li> ";
			}
			;
			echo "<li><a href='hastaGoruntule.php?page=$total_pages'>" . ' Sona git' . "</a></li> "; // Goto last page
			
		?>
									</ul>
								</div>
							</div> <div class="col-xs-3" align="right"><?php echo "Sayfa: ".$page." / ".$total_pages;?></div>
						</div>
					</div>
				</div>
			</div>
		  	
		  	
		  	</div>
		  </div>
		</div>
    </div>

    <?php print getFooter(); ?>