<!-- Styler -->
<style type="text/css">
.panel * {
	font-family: "Arial","​Helvetica","​sans-serif";
}
.fa {
	font-family: "FontAwesome";
}
.datagrid-header-row * {
	font-weight: bold;
}
.messager-window * a:focus, .messager-window * span:focus {
	color: blue;
	font-weight: bold;
}
.daterangepicker * {
	font-family: "Source Sans Pro","Arial","​Helvetica","​sans-serif";
	box-sizing: border-box;
}
.glyphicon	{font-family: "Glyphicons Halflings"}

.form-control {
	height: 20px;
	padding: 4px;
}	
</style>

<div class="row">
	<div class="col-md-12">
		<div class="box box-solid box-primary">
			<div class="box-header">
				<h3 class="box-title"> Cetak Laporan Data Anggota</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-primary btn-sm" data-widget="collapse">
							<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body">
			<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-print" plain="false" onclick="cetak()"> Cetak Laporan</a>
			<p></p>
			<p style="text-align:center; font-size: 15pt; font-weight: bold;"> Laporan Data Anggota </p>
			<table  class="table table-bordered">
			<tr class="header_kolom">
				<th style="width:4%; vertical-align: middle; text-align:center" > No. </th>
				<th style="width:10%; vertical-align: middle; text-align:center"> ID Anggota </th>
				<th style="width:25%; vertical-align: middle; text-align:center"> Nama Anggota </th>
				<th style="width:3%; vertical-align: middle; text-align:center"> L/P  </th>
				<!-- <th style="width:10%; vertical-align: middle; text-align:center"> Jabatan  </th> -->
				<th style="width:20%; vertical-align: middle; text-align:center"> Alamat </th>
				<th style="width:10%; vertical-align: middle; text-align:center"> Status </th>
				<!-- <th style="width:10%; vertical-align: middle; text-align:center"> Tgl Registrasi </th> -->
				<th style="width:10%; vertical-align: middle; text-align:center">Photo</th>
			</tr>

			<?php
				$no = $offset + 1;
				$mulai=1;
				if (!empty($data_anggota)) {

					foreach ($data_anggota as $row) {

						if(($no % 2) == 0) {
							$warna="#EEEEEE";
						} else {
							$warna="#FFFFFF";
						}

						//photo
						$photo_w = 3 * 15;
						$photo_h = 4 * 15;
						if($row->file_pic == '') {
							$photo ='<img src="'.base_url().'assets/theme_admin/img/photo.jpg" alt="default" width="'.$photo_w.'" height="'.$photo_h.'" />';
						} else {
							$photo= '<img src="'.base_url().'uploads/anggota/' . $row->file_pic . '" alt="Foto" width="'.$photo_w.'" height="'.$photo_h.'" />';
						}

						//status
						if ($row->aktif == "Y"){
							$status="Aktif";
						} else {
							$status="Non-Aktif";
						}

						// $tgl_reg  = explode(' ', $row->tgl_daftar);
						// $txt_tanggal = jin_date_ina($tgl_reg[0],'p');

						$tgl_lahir = explode(' ', $row->tgl_lahir);
						$txt_lahir = jin_date_ina($tgl_lahir[0],'full');
						// AG'.sprintf('%04d', $row->id).'
						echo '
						<tr bgcolor='.$warna.' >
						<td class="h_tengah" style="vertical-align: middle "> '.$no++.' </td>
						<td class="h_tengah" style="vertical-align: middle "> A-'.sprintf('%04d', $row->id).'<br>'.$row->identitas.'</td>
						<td class="h_kiri" style="vertical-align: middle "><b> '.strtoupper($row->nama).'</b> <br> '.$row->tmp_lahir.', '.$txt_lahir.'</td>
						<td class="h_tengah" style="vertical-align: middle "> '.$row->jk.'</td>
						<td style="vertical-align: middle"> '.$row->alamat.' <br> Telp. '. $row->notelp.'  </td>
						<td class="h_tengah" style="vertical-align: middle "> '.$status.'</td>
						<td class="h_tengah" style="vertical-align: middle "> '.$photo.'</td>
						</tr>';
					}
					echo '</table>
					<div class="box-footer">'.$halaman.'</div>';
				} else {
					echo '<tr>
						<td colspan="9" >
							<code> Tidak Ada Data <br> </code>
						</td>
					</tr>';
				}
			?>
			</div>
		</div>


<script type="text/javascript">
function cetak () {
	var win = window.open('<?php echo site_url("lap_anggota/cetak"); ?>');
	if (win) {
		win.focus();
	} else {
		alert('Popup jangan di block');
	}
}
</script>