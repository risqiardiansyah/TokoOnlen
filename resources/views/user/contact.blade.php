@extends('template.template')

@section('content')

<!-- Contact Info -->

<div class="contact_info">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="{{url('assets/images/contact_1.png')}}" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Telp/WA</div>
								<div class="contact_info_text">+62 8822 5146 375</div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="{{url('assets/images/contact_2.png')}}" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Email</div>
								<div class="contact_info_text">ardiris19@gmail.com</div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><img src="{{url('assets/images/contact_3.png')}}" alt=""></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Alamat</div>
								<div class="contact_info_text">Parakancanggah, RT 04/05, Banjarnegara, Jawa Tengah.</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact Form -->

	<div class="contact_form">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1">
					<div class="contact_form_container">
						<div class="contact_form_title">Berikan Masukkan Kepada Kami</div>

						<form action="#" id="contact_form">
							<div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
								<input type="text" id="contact_form_name" class="contact_form_name input_field" placeholder="Nama" required="required" data-error="Name is required.">
								<input type="text" id="contact_form_email" class="contact_form_email input_field" placeholder="Email" required="required" data-error="Email is required.">
								<input type="text" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Nomor HP">
							</div>
							<div class="contact_form_text">
								<textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Pesan/kritik" required="required" data-error="Please, write us a message."></textarea>
							</div>
							<div class="contact_form_button">
								<button type="submit" class="button contact_submit_button">Kirim</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
		<div class="panel"></div>
	</div>

@endsection