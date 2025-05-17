<!-- Sign in Form -->
<section class="sign-in" style="background-color: #6DABE4;">
    <div class="container">
        <div class="signin-content">
            <img src="<?= base_url() ?>assets/auth/images/icon1.png">
            <div class="signin-form">
                <h2 class="form-title">Login Staff</h2>
                <form action="<?= base_url() ?>auth/prosesLoginPegawai" method="POST" class="register-form" id="login-form">
                    <?= $this->session->flashdata('message'); ?><br>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="email" id="email" placeholder="Email" autofocus required />
                    </div>
                    <div class="form-group" style="position: relative;">
                        <label for="Password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="Password" required />
                        <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <i class="zmdi zmdi-eye-off" id="eyeIcon"></i>
                        </span>
                    </div>
                    <div class="form-group">
                        <a href="<?= base_url() ?>lupapassword/reset">Lupa Password?</a>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                    </div>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const togglePassword = document.getElementById('togglePassword');
                        const password = document.getElementById('password');
                        const eyeIcon = document.getElementById('eyeIcon');

                        togglePassword.addEventListener('click', function() {
                            // Toggle password visibility
                            if (password.type === 'password') {
                                password.type = 'text';
                                eyeIcon.classList.remove('zmdi-eye-off');
                                eyeIcon.classList.add('zmdi-eye');
                            } else {
                                password.type = 'password';
                                eyeIcon.classList.remove('zmdi-eye');
                                eyeIcon.classList.add('zmdi-eye-off');
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</section>