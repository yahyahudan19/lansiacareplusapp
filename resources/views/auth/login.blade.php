{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
        <base href="../../../" />
        <title>Login Page | SIM Lansia</title>
        <meta charset="utf-8" />
        <meta name="description" content="Aplikasi untuk manajemen pendataan masyarakat lansia dan pra-lansia di Kota Malang" />
        <meta name="keywords" content="Kota Malang, Lansia, Pra-Lansia, Peduli, Kesehatan" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="id_ID" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Lansia Care+ | Aplikasi Lansia Kota Malang" />
        <meta property="og:url" content="#" />
        <meta property="og:site_name" content="Lansia Care+ by YH" />
		<link rel="shortcut icon" href="{{ asset('template/assets/media/logos/favicon.ico')}}" />
		<!--begin::Fonts(mandatory for all pages)-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
		<link href="{{ asset('template/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('template/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
		<script>// Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }</script>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
		<!--begin::Theme mode setup on page load-->
		<script>
			var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }
		</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::Root-->
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<!--begin::Page bg image-->
			<style>body { background-image: url('{{ asset('template/assets/media/auth/bg10.jpeg')}}'); } [data-bs-theme="dark"] body { background-image: url('{{ asset('template/assets/media/auth/bg10-dark.jpeg')}}'); }</style>
			<!--end::Page bg image-->
			<!--begin::Authentication - Sign-in -->
			<div class="d-flex flex-column flex-lg-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-lg-row-fluid">
					<!--begin::Content-->
					<div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
						<!--begin::Image-->
						<img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('template/assets/media/auth/agency.png')}}" alt="" />
						<img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('template/assets/media/auth/agency-dark.png')}}" alt="" />
						<!--end::Image-->
						<!--begin::Title-->
						<h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">SIM Lansia</h1>
						<!--end::Title-->
						<!--begin::Text-->
						<div class="text-gray-600 fs-base text-center fw-semibold">Aplikasi Pendataan Lansia Kota Malang , Selamat Menggunakan !
						{{-- <a href="#" class="opacity-75-hover text-primary me-1">the blogger</a>introduces a person they’ve interviewed 
						<br />and provides some background information about 
						<a href="#" class="opacity-75-hover text-primary me-1">the interviewee</a>and their 
						<br />work following this is a transcript of the interview.</div> --}}
						<!--end::Text-->
					</div>
					<!--end::Content-->
				</div>
				<!--begin::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
					<!--begin::Wrapper-->
					<div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
						<!--begin::Content-->
						<div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
							<!--begin::Wrapper-->
							<div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
								<!--begin::Form-->
								<form method="POST" action="{{ route('login') }}" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="/dashboard">
									@csrf
                                    <!--begin::Heading-->
									<div class="text-center mb-11">
										<!--begin::Title-->
										<h1 class="text-gray-900 fw-bolder mb-3">Masuk</h1>
										<!--end::Title-->
										<!--begin::Subtitle-->
										<div class="text-gray-500 fw-semibold fs-6">Aplikasi SIM Lansia</div>
										<!--end::Subtitle=-->
									</div>
									<!--begin::Input group=-->
									<div class="fv-row mb-8">
										<!--begin::Email-->
										<input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
										<!--end::Email-->
									</div>
									<!--end::Input group=-->
									<div class="fv-row mb-3 position-relative">
										<!--begin::Password-->
										<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" id="password-input" />
										<!--end::Password-->
										<span class="position-absolute top-50 end-0 translate-middle-y me-3 cursor-pointer" onclick="togglePasswordVisibility()">
											<i class="bi bi-eye-slash" id="password-icon"></i>
										</span>
									</div>
									
									<!--end::Input group=-->
									<!--begin::Wrapper-->
									<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
										<div></div>
										<!--begin::Link-->
										{{-- <a href="#" class="link-primary">Forgot Password ?</a> --}}
										<!--end::Link-->
									</div>
									<!--end::Wrapper-->
									<!--begin::Submit button-->
									<div class="d-grid mb-10">
										<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
											<!--begin::Indicator label-->
											<span class="indicator-label">Masuk</span>
											<!--end::Indicator label-->
											<!--begin::Indicator progress-->
											<span class="indicator-progress">Silahkan Tunggu... 
											<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
											<!--end::Indicator progress-->
										</button>
									</div>
									<!--end::Submit button-->
									<!--begin::Sign up-->
									{{-- <div class="text-gray-500 text-center fw-semibold fs-6">Belum punya akun ? 
									<a href="#" class="link-primary">Hubungi Kami</a></div> --}}
									<!--end::Sign up-->
								</form>
								<!--end::Form-->
							</div>
							<!--end::Wrapper-->
							<!--begin::Footer-->
							{{-- <div class="d-flex flex-stack">
								<!--begin::Links-->
								<div class="d-flex fw-semibold text-primary fs-base gap-5">
									<a href="#" target="_blank">Terms</a>
									<a href="#" target="_blank">Contact Us</a>
								</div>
								<!--end::Links-->
							</div> --}}
							<!--end::Footer-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Body-->
			</div>
			<!--end::Authentication - Sign-in-->
		</div>
		<!--end::Root-->
		<!--begin::Javascript-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Global Javascript Bundle(mandatory for all pages)-->
		<script src="{{ asset('template/assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{ asset('template/assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Custom Javascript(used for this page only)-->
		<script>
			"use strict";

			// Class definition
			var KTSigninGeneral = function () {
				// Elements
				var form;
				var submitButton;
				var validator;

				// Handle form
				var handleValidation = function (e) {
					// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
					validator = FormValidation.formValidation(
						form,
						{
							fields: {
								'email': {
									validators: {
										regexp: {
											regexp: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
											message: 'Nilai ini bukan alamat email yang valid',
										},
										notEmpty: {
											message: 'Alamat email wajib diisi'
										}
									}
								},
								'password': {
									validators: {
										notEmpty: {
											message: 'Kata sandi wajib diisi'
										}
									}
								}
							},
							plugins: {
								trigger: new FormValidation.plugins.Trigger(),
								bootstrap: new FormValidation.plugins.Bootstrap5({
									rowSelector: '.fv-row',
									eleInvalidClass: '',  // comment to enable invalid state icons
									eleValidClass: '' // comment to enable valid state icons
								})
							}
						}
					);
				}

				var handleSubmitDemo = function (e) {
					// Handle form submit
					submitButton.addEventListener('click', function (e) {
						// Prevent button default action
						e.preventDefault();

						// Validate form
						validator.validate().then(function (status) {
							if (status == 'Valid') {
								// Show loading indication
								submitButton.setAttribute('data-kt-indicator', 'on');

								// Disable button to avoid multiple click
								submitButton.disabled = true;


								// Simulate ajax request
								setTimeout(function () {
									// Hide loading indication
									submitButton.removeAttribute('data-kt-indicator');

									// Enable button
									submitButton.disabled = false;

									// Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
									Swal.fire({
										text: "Anda berhasil masuk!",
										icon: "success",
										buttonsStyling: false,
										confirmButtonText: "Oke, mengerti!",
										customClass: {
											confirmButton: "btn btn-primary"
										}
									}).then(function (result) {
										if (result.isConfirmed) {
											form.querySelector('[name="email"]').value = "";
											form.querySelector('[name="password"]').value = "";

											//form.submit(); // submit form
											var redirectUrl = form.getAttribute('data-kt-redirect-url');
											if (redirectUrl) {
												location.href = redirectUrl;
											}
										}
									});
								}, 2000);
							} else {
								// Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
								Swal.fire({
									text: "Maaf, sepertinya ada beberapa kesalahan yang terdeteksi, silakan coba lagi.",
									icon: "error",
									buttonsStyling: false,
									confirmButtonText: "Oke, mengerti!",
									customClass: {
										confirmButton: "btn btn-primary"
									}
								});
							}
						});
					});
				}

				var handleSubmitAjax = function (e) {
					// Handle form submit
					submitButton.addEventListener('click', function (e) {
						// Prevent button default action
						e.preventDefault();

						// Validate form
						validator.validate().then(function (status) {
							if (status == 'Valid') {
								// Show loading indication
								submitButton.setAttribute('data-kt-indicator', 'on');

								// Disable button to avoid multiple click
								submitButton.disabled = true;

								// Check axios library docs: https://axios-http.com/docs/intro
								axios.post(submitButton.closest('form').getAttribute('action'), new FormData(form)).then(function (response) {
									if (response) {
										form.reset();

										// Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
										Swal.fire({
											text: "Anda berhasil masuk!",
											icon: "success",
											buttonsStyling: false,
											confirmButtonText: "Oke, mengerti!",
											customClass: {
												confirmButton: "btn btn-primary"
											}
										});

										const redirectUrl = form.getAttribute('data-kt-redirect-url');

										if (redirectUrl) {
											location.href = redirectUrl;
										}
									} else {
										// Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
										Swal.fire({
											text: "Maaf, email atau kata sandi salah, silakan coba lagi.",
											icon: "error",
											buttonsStyling: false,
											confirmButtonText: "Oke, mengerti!",
											customClass: {
												confirmButton: "btn btn-primary"
											}
										});
									}
								}).catch(function (error) {
									Swal.fire({
										text: "Maaf, sepertinya ada beberapa kesalahan yang terdeteksi, silakan coba lagi.",
										icon: "error",
										buttonsStyling: false,
										confirmButtonText: "Oke, mengerti!",
										customClass: {
											confirmButton: "btn btn-primary"
										}
									});
								}).then(() => {
									// Hide loading indication
									submitButton.removeAttribute('data-kt-indicator');

									// Enable button
									submitButton.disabled = false;
								});
							} else {
								// Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
								Swal.fire({
									text: "Maaf, sepertinya ada beberapa kesalahan yang terdeteksi, silakan coba lagi.",
									icon: "error",
									buttonsStyling: false,
									confirmButtonText: "Oke, mengerti!",
									customClass: {
										confirmButton: "btn btn-primary"
									}
								});
							}
						});
					});
				}

				var isValidUrl = function(url) {
					try {
						new URL(url);
						return true;
					} catch (e) {
						return false;
					}
				}

				// Public functions
				return {
					// Initialization
					init: function () {
						form = document.querySelector('#kt_sign_in_form');
						submitButton = document.querySelector('#kt_sign_in_submit');

						handleValidation();

						if (isValidUrl(submitButton.closest('form').getAttribute('action'))) {
							handleSubmitAjax(); // use for ajax submit
						} else {
							handleSubmitDemo(); // used for demo purposes only
						}
					}
				};
			}();

			// On document ready
			KTUtil.onDOMContentLoaded(function () {
				KTSigninGeneral.init();
			});

		</script>
		<!--end::Custom Javascript-->
		<script>
			function togglePasswordVisibility() {
				const passwordInput = document.getElementById('password-input');
				const passwordIcon = document.getElementById('password-icon');
				if (passwordInput.type === 'password') {
					passwordInput.type = 'text';
					passwordIcon.classList.remove('bi-eye-slash');
					passwordIcon.classList.add('bi-eye');
				} else {
					passwordInput.type = 'password';
					passwordIcon.classList.remove('bi-eye');
					passwordIcon.classList.add('bi-eye-slash');
				}
			}
		</script>
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
