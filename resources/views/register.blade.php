<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ route('index') }}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('img/logo.png') }}" alt="">
                                    <span class="d-none d-lg-block">NiceAdmin</span>
                                </a>
                            </div>

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Register</h5>
                                    </div>

                                    <form action="{{ route('register') }}" method="post"> @csrf
                                        <div class="col-12">
                                            <label for="name" class="form-label">Name</label>
                                            <div class="input-group has-validation">
                                                <input type="text" id="name" name="name"
                                                    class="form-control" id="name" required>
                                                <div class="invalid-feedback">Please choose a name.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="phone_number" class="form-label">Phone Number</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">+993</span>
                                                <input type="number" id="number" name="phone_number"
                                                    class="form-control" id="phone_number" required>
                                                <div class="invalid-feedback">Please choose a phone number.</div>
                                            </div>
                                        </div>
                                        {{-- <div id="recaptcha-container"></div> --}}
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit"
                                                onclick="SendCode();">Create Account</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a
                                                    href="{{ route('login') }}">Login</a></p>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
    {{-- <script src="https://www.gstatic.com/firebasejs/7.20.0/firebase.js"></script>

    <script>
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyCs8m7dhblSqjPQc8uwXy24hBcroVFYN9E",
            authDomain: "laravelfirebase-3f57a.firebaseapp.com",
            databaseURL: "https://laravelfirebase-3f57a-default-rtdb.firebaseio.com",
            projectId: "laravelfirebase-3f57a",
            storageBucket: "laravelfirebase-3f57a.appspot.com",
            messagingSenderId: "395724068748",
            appId: "1:395724068748:web:572b0062205f23af9c28a9",
            measurementId: "G-04RP4ZWNY4"
        };

        firebase.initializeApp(firebaseConfig);
    </script>

    <script type="text/javascript">
        window.onload = function() {
            render();
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }

        function SendCode() {

            var number = $("#number").val();

            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult) {

                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;

                $("#sentSuccess").text("Message Sent Successfully.");
                $("#sentSuccess").show();

            }).catch(function(error) {
                $("#error").text(error.message);
                $("#error").show();
            });

        }

        function VerifyCode() {

            var code = $("#verificationCode").val();

            coderesult.confirm(code).then(function(result) {
                var user = result.user;

                $("#successRegsiter").text("You Are Register Successfully.");
                $("#successRegsiter").show();

            }).catch(function(error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
    </script> --}}
    <script src="{{ asset('vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/jquery-1.8.3.min.js') }}"></script>
    <script src="{{ asset('js/previewImg.js') }}"></script>

</body>

</html>
