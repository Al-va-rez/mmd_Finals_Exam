    $('.inputBox').addClass('border border-gray-500 rounded-md focus:cursor-none focus:outline-blue-500');

    $('.inputField').addClass('flex flex-col w-full text-xl');


    $('#registerForm').on('submit',
        function(event) {
            event.preventDefault();

            var formData = {
                userRole: $('#formUserRole').val(),
                username: $('#formUsername').val(),
                firstName: $('#formFirstName').val(),
                lastName: $('#formLastName').val(),
                password: $('#formPassword').val(),
                confirmPassword: $('#formConfirmPassword').val(),
                registerReq: 1
            };


            $.ajax(
                {
                    type: "POST",
                    url: "core/handleForms.php",
                    data: formData,
                    success: function(data) {
                        switch (data) {
                            case 'Success':
                                alert("Registration successful! Close the message to redirect to login page...");
                                setTimeout(function() {
                                    window.location.href = "login.php";
                                }, 500);
                                break;
                            
                            case 'Weak password':
                                alert(data);
                                break;
                            
                            case 'Passwords not the same':
                                alert(data);
                                break;
                            
                            case 'User already registered':
                                alert(data);
                                break;

                            case 'Password already in use':
                                alert(data);
                                break;
                        
                            default:
                                console.log('something went wrong');
                                break;
                        }
                        
                    }
                }
            )
        }
    )


    $('#loginForm').on('submit',
        function(event) {
            event.preventDefault();

            var formData = {
                username: $('#formUsername').val(),
                password: $('#formPassword').val(),
                loginReq: 1
            };


            $.ajax(
                {
                    type: "POST",
                    url: "core/handleForms.php",
                    data: formData,
                    success: function(data) {
                        switch (data) {
                            case 'Login as admin':
                                window.location.href = "role_Admin/admin_Home1.php";
                                break;
                            
                            case 'Login as user':
                                window.location.href = "role_User/user_Homepage.php";
                                break;
                            
                            case 'Incorrect Password':
                                alert(data);
                                break;
                            
                            case 'User not yet registered':
                                alert(data);
                                break;
                        
                            default:
                                console.log('something went wrong');
                                break;
                        }
                        
                    }
                }
            )
        }
    )