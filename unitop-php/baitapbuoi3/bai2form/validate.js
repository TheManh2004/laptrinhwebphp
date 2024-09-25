function validateForm() {
    var firstNameuser = document.getElementById("firstName").value;
    var lastNameuser = document.getElementById("lastName").value;
    var gmail = document.getElementById("mail").value;
    var invoiceId = document.getElementById("invoiceId").value;
    var errorMessage = document.getElementById("error-message");
    var payForCheckboxes = document.getElementsByName("pay_for[]");

    if (firstNameuser == "") {
        errorMessage.textContent = "Firstname không được để trống";
        return false;
    }
    if (lastNameuser == "") {
        errorMessage.textContent = "LastName không được để trống";
        return false;
    }
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(gmail)) {
        errorMessage.textContent = "Vui lòng nhập 1 gmail hợp lệ";
        return false;
    }
    if (isNaN(invoiceId) || invoiceId == "") {
        errorMessage.textContent = "ID phải là số . Vui lòng nhập hợp lệ";
        return false;
    }
    var isChecked = false;
    for (var i = 0; i < payForCheckboxes.length; i++) {
        if (payForCheckboxes[i].checked) {
            isChecked = true;
            break;
        }
    }
    if (!isChecked) {
        errorMessage.textContent = "Bạn phải chọn ít nhất một mục trong 'Pay For'";
        return false;
    }

    errorMessage.textContent = "";
    return true;
}