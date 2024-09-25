// validate.js
function validateForm() {
    var namesach = document.getElementById("name").value;
    var nameauthor = document.getElementById("author").value;
    var namexuatban = document.getElementById("xuatban").value;
    var number = document.getElementById("nam").value;
    var errorMessage = document.getElementById("error-message");

    if (namesach == "") {
        errorMessage.textContent = "Tên sách không được để trống";
        return false;
    }
    if (nameauthor == "") {
        errorMessage.textContent = "Tên tác giả không được để trống";
        return false;
    }
    if (namexuatban == "") {
        errorMessage.textContent = "Nhà xuất bản không được để trống";
        return false;
    }
    if (isNaN(number) || number == "") {
        errorMessage.textContent = "Năm xuất bản phải là số";
        return false;
    }
    errorMessage.textContent = "";
    return true;
}