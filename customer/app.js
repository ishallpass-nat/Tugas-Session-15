console.log("Javascript berhasil dimuat");

const toggleButton = document.querySelector("#toggleTips");
const formTips = document.querySelector("#formTips");
const customerForm = document.querySelector("#customerForm");
const nameInput = document.querySelector("#name");
const emailInput = document.querySelector("#email");
const numberInput = document.querySelector("#number");
const nameFeedback = document.querySelector("#nameFeedback");
const emailFeedback = document.querySelector("#emailFeedback");
const numberFeedback = document.querySelector("#numberFeedback");
const formMessage = document.querySelector("#formMessage");

toggleButton.addEventListener("click", function(){
    formTips.hidden = !formTips.hidden;
//jika form tips atribut hiddennya true maka text nya tulis tampilkan petunjuk, jika sebaliknya
// jika sebaliknya tampilkan sembbunyikan petunjuk
    toggleButton.textContent = formTips.hidden ? "Tampilkan Petunjuk" : "sembunyikan Petunjuk";

});
nameInput.addEventListener("input", function(){
    if(nameInput.value.trim() === ""){
        nameFeedback.textContent = "nama belum diisi";

    }else{
        nameFeedback.textContent = "Nama sudah diisi."

    }
});

emailInput.addEventListener("input", function(){
    if(emailInput.value.trim() === ""){
        emailFeedback.textContent = "email belum diisi";
    }else if(!emailInput.validity.valid){
        emailFeedback.textContent = "Periksa Format email";
    }else{
        emailFeedback.textContent = "Format Email Valid";
    }
});
numberInput.addEventListener("input", function(){
    if(numberInput.value.trim() === ""){
        numberFeedback.textContent = "nomor belum diisi";
    }else if(!numberInput.validity.valid){
        numberFeedback.textContent = "Periksa Format nomor";
    }else{
        numberFeedback.textContent = "Format nomor Valid";
    }

});

customerForm.addEventListener("submit", function(event) {
    let hasError = false;

    nameFeedback.textContent = "";
    emailFeedback.textContent = "";
    numberFeedback.textContent = "";
    formMessage.textContent = "";


    if(nameInput.value.trim() == ""){
        event.preventDefault();
        nameFeedback.textContent = "nama wajib diisi";
        hasError = true;

    }
    if(emailInput.value.trim() == "" || !emailInput.validity.valid){
        event.preventDefault();
        emailFeedback.textContent = "email wajib diisi dan pastikan formatnya benar";
        hasError = true;
        
    }
    if(numberInput.value.trim() == ""|| !numberInput.validity.valid){
        event.preventDefault();
        numberFeedback.textContent = "nomor wajib diisi";
        hasError = true;

    }

    if(hasError){
        formMessage.textContent = "perbaiki input yang masih salah";

    }else{
        formMessage.textContent = "Data sudah bisa diproses";
    }
});

// tabmahin 1 inputan yaitu nomor telpnya
//index, submit,customer, success