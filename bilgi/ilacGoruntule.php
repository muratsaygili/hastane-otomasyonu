<?php 
include_once 'config.php';
include_once 'functions.php';

print getHeader("İlaçlar");
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
					<div class="panel-title"><h2>İlaç Listesi</h2></div>
					<input class="btn btn-success" type="button" value="İlaç Ekle" 
				onclick="window.open('ilacEkle.php','ornekpencere',' width=400,height=600,left=300,top=30');">
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
										aria-sort="ascending" style="width: 5px;" colspan="1"
										rowspan="1" aria-controls="example" tabindex="0"
										role="columnheader" class="sorting_asc">İlaç ID</th>
									<th aria-label="Browser: activate to sort column ascending"
										style="width: 200px;" colspan="1" rowspan="1"
										aria-controls="example" tabindex="0" role="columnheader"
										class="sorting">İlaç Adı</th>
									<th aria-label="Browser: activate to sort column ascending"
										style="width: 200px;" colspan="1" rowspan="1"
										aria-controls="example" tabindex="0" role="columnheader"
										class="sorting">Barkod Numarası</th>
									<th aria-label="Browser: activate to sort column ascending"
										style="width: 200px;" colspan="1" rowspan="1"
										aria-controls="example" tabindex="0" role="columnheader"
										class="sorting">Stok Miktarı</th>
									<th aria-label="Browser: activate to sort column ascending"
										style="width: 200px;" colspan="1" rowspan="1"
										aria-controls="example" tabindex="0" role="columnheader"
										class="sorting">Tipi</th>
								</tr>
							</thead>

							<tbody aria-relevant="all" aria-live="polite" role="alert">
		 		<?php
			$num_rec_per_page = 20;
			if (isset ( $_GET ["page"] )) {
				$page = $_GET ["page"];
			} else {
				$page = 1;
			}
			if($page<=0)
				$page=1;
			$start_from = ($page - 1) * $num_rec_per_page;
			
			
			$sql = "SELECT * FROM ilac LIMIT $start_from, $num_rec_per_page";
			$rs_result = mysql_query ( $sql ); // run the query
			while ( $row = mysql_fetch_assoc ( $rs_result ) ) {
				
				echo '
						<tr class="gradeA odd"> 
							<td class="  sorting_1"><strong>'.$row['ilac_no'].'</strong>  </td>
							<td class=" ">'.$row['ilac_ad'].'</a></td>
							<td class=" ">'.$row['ilac_barkod_no'].'</a></td>
							<td class=" ">'.$row['ilac_miktar'].'</a>';
						?> <input class="btn btn-success pull-right btn-xs" type="button" value="Güncelle" 
				onclick="window.open('ilacGuncelle.php?ilac_no=<?php echo $row['ilac_no'];?>','ornekpencere',' width=400,height=600,left=300,top=30');">
				
				<?php
				
					echo '	</td>
							<td class=" ">'.$row['ilac_tipi'].'</a></td>
						</tr>';
			}
			$sql = "SELECT * FROM ilac";
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
			$sql = "SELECT * FROM ilac";
			$rs_result = mysql_query ( $sql ); // run the query
			$total_records = mysql_num_rows ( $rs_result ); // count number of records
			$total_pages = ceil ( $total_records / $num_rec_per_page );
			echo "<li><a href='ilacGoruntule.php?page=1'>" . 'Başa dön ' . "</a> </li>"; // Goto 1st page
			
			for($i = 1; $i <= $total_pages; $i ++) {
				echo "<li><a href='ilacGoruntule.php?page=" . $i . "'>" . $i . " </a></li> ";
			}
			;
			echo "<li><a href='ilacGoruntule.php?page=$total_pages'>" . ' Sona git' . "</a></li> "; // Goto last page
			
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