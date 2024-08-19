/* eslint-env es6 */
/* eslint-disable no-console */
/* eslint-env es6 */
/* eslint-disable */
function validateForm() {
  const registrationForm = document.getElementById('registrationForm');

  registrationForm.addEventListener('submit', function(event) {
  event.preventDefault();

  // Lấy giá trị từ các trường nhập liệu
  const username = document.getElementById('username').value;
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirmPassword').value;
  const email = document.getElementById('email').value;
  const firstName = document.getElementById('firstName').value;
  const lastName = document.getElementById('lastName').value;
  const phone = document.getElementById('phone').value;

  // Biến để lưu trữ thông báo lỗi
  let errorMessages = '';

  // Validation tên đăng nhập
  if (username.trim() === '') {
    errorMessages += 'Tên đăng nhập không được để trống.\n';
  } else if (username.length < 6 || username.length > 20) {
    errorMessages += 'Tên đăng nhập phải có độ dài từ 6 đến 20 ký tự.\n';
  } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
    errorMessages += 'Tên đăng nhập chỉ được chứa chữ cái, số và gạch dưới.\n';
  }

  // Validation mật khẩu
  if (password.trim() === '') {
    errorMessages += 'Mật khẩu không được để trống.\n';
  } else if (password.length < 8) {
    errorMessages += 'Mật khẩu phải có ít nhất 8 ký tự.\n';
  } else if (!/[a-zA-Z0-9!@#$%^&*]+/.test(password)) {
    errorMessages += 'Mật khẩu phải chứa ít nhất một chữ cái, một số và một ký tự đặc biệt.\n';
  }

  // Validation xác nhận mật khẩu
  if (confirmPassword.trim() === '') {
    errorMessages += 'Xác nhận mật khẩu không được để trống.\n';
  } else if (confirmPassword !== password) {
    errorMessages += 'Xác nhận mật khẩu không khớp với mật khẩu.\n';
  }

  // Validation email
  if (email.trim() === '') {
    errorMessages += 'Email không được để trống.\n';
  } else if (!/^[\w-.]+@([\w-]+\.)+[a-zA-Z]{2,}$/.test(email)) {
    errorMessages += 'Email không hợp lệ.\n';
  }

  // Validation tên
  if (firstName.trim() === '') {
    errorMessages += 'Tên không được để trống.\n';
  } else if (!/^[a-zA-Z]+$/.test(firstName)) {
    errorMessages += 'Tên chỉ được chứa chữ cái.\n';
  }

  // Validation họ
  if (lastName.trim() === '') {
    errorMessages += 'Họ không được để trống.\n';
  } else if (!/^[a-zA-Z]+$/.test(lastName)) {
    errorMessages += 'Họ chỉ được chứa chữ cái.\n';
  }

  // Validation số điện thoại (tùy chỉnh định dạng theo yêu cầu)
  if (phone.trim() === '') {
    errorMessages += 'Số điện thoại không được để trống.\n';
  } else if (!/^\d{10}$/.test(phone)) {
    errorMessages += 'Số điện thoại không hợp lệ (phải có 10 chữ số).';
  }

  // Hiển thị thông báo lỗi
  if (errorMessages) {
    alert(errorMessages);
    return false; // Ngăn chặn submit form
  } else {
    // Submit form nếu không có lỗi
    alert('Đăng ký thành công!');
	// Lưu trữ thông tin đăng nhập vào localStorage
	localStorage.setItem('loggedInUser', JSON.stringify({ username: username }));

    return true;
  }
}

// Thêm sự kiện click vào nút submit form
const submitButton = document.getElementById('submitButton');
submitButton.addEventListener('click', validateForm);
