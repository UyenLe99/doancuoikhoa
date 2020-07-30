<!DOCTYPE html>
<html>
<head>
	<link href="{{asset('css/dat_hang.css')}}" rel="stylesheet" />
</head>
<body>
	<div class="container">  
	  <form id="contact" action="{{route('process_dat_hang')}}" method="post">
	  	{{csrf_field()}}
	    <h3>Đặt xe </h3>
	    <h4>Please fill in contact below...</h4>

	    <fieldset>
	      <input placeholder="Ngày Đặt" type="date" name="Ngay" tabindex="1" required autofocus>
	    </fieldset>

	  	<div class="row">
		    <div class="col-25">
		      	<label for="fname"></label>
		    </div>
		    <div class="col-75">
		    	<div class="form-control">
		    		<input type="text" name="Ma_khach_hang" value="{{$ma_khach_hang}}" hidden>
		    		<input type="text" value="{{$ten_dang_nhap}}" readonly>
		    	</div>
		    </div>
	  	</div>

	  	<div class="row">
	    	<div class="col-75">
				<div class="form-control">
					<input type="text" value="{{$xe->Ten_xe}}" readonly>
					<input type="text" name="Ma_xe" value="{{$xe->Ma_xe}}" hidden>
				</div>      
	    	</div>
	  	</div>

	    <fieldset>
	      <input placeholder="Người nhận" type="text" name="Ten_Nguoi_nhan" tabindex="1" required autofocus>
	    </fieldset>

	    <fieldset>
	      <input placeholder="Số Điện Thoại" type="text" name="Sdt_Nguoi_nhan" tabindex="1" required autofocus>
	    </fieldset>

	    <fieldset>
	      <input placeholder="Địa Chỉ" type="text" name="Dc_Nguoi_nhan" tabindex="1" required autofocus>
	    </fieldset>

	    <fieldset>
	      <input id="js-ngay-nhan" placeholder="Ngày Lấy Xe" type="date" name="Ngay_lay" tabindex="1" required autofocus>
	    </fieldset>

	    <fieldset>
	      <input id="js-ngay-tra" placeholder="Ngày Trả Xe" type="date" name="Ngay_tra" tabindex="1" required autofocus>
	    </fieldset>

		<div>
		    Tong tien: <span id="js-tong-tien">0</span> vnđ
		    <input id="js-input-tong-tien" name="Tong_tien" type="password" hidden>
		</div>

	    <fieldset>
	      <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
	    </fieldset>
	  </form>
	</div>
</body>

<script>
	const gia = parseInt('{{$xe->Gia}}'.replace(/\./g, '');
	const $input_tong_tien = document.getElementById('js-input-tong-tien');
	const $tong_tien = document.getElementById('js-tong-tien');
	const $ngay_nhan = document.getElementById('js-ngay-nhan');
	const $ngay_tra = document.getElementById('js-ngay-tra');

	$ngay_nhan.addEventListener('change', khi_ngay_thay_doi);
	$ngay_tra.addEventListener('change', khi_ngay_thay_doi);

	function tinh_tien(ngay_nhan, ngay_tra) {
		const so_ngay = (new Date(ngay_tra) - new Date(ngay_nhan)) / 86400000
		return so_ngay * gia;
	}

	function khi_ngay_thay_doi() {
		const ngay_nhan = $ngay_nhan.value
		const ngay_tra = $ngay_tra.value
		if (ngay_nhan && ngay_tra) {
			const tong_tien = tinh_tien(ngay_nhan, ngay_tra)
				.toString().replace(/\d(?=(\d{3})+$)/g, '$&.');
			$tong_tien.innerHTML = tong_tien
			$input_tong_tien.value = `${tong_tien} vnđ`
		}
	}
</script>

</html>
