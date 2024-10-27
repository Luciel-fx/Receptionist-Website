let firstName = document.getElementById("firstName");
let lastName = document.getElementById("lastName");
let pass = document.getElementById("password");
let id = document.getElementById("idNum");
let phone = document.getElementById("phoNum");
let email = document.getElementById("email");
let emailConfirm = document.getElementById("eConfirm");
emailConfirm.addEventListener("change", function() {
   let reqText = document.getElementById("eReq");
   if (this.checked) {
      reqText.style.display = 'inline';
   } 
   else {
      reqText.style.display = 'none';
   }
});
let form = document.querySelector("form");
form.addEventListener("submit", validate);
function validate(event) {
   let firstValid = /^[A-Za-z]+$/.test(firstName.value);
   let lastValid = /^[A-Za-z]+$/.test(lastName.value);
   let passValid = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{3,16}$/.test(pass.value);
   let idValid = /^\d{4}$/.test(id.value);
   let phoneValid = /^\d{3}-\d{3}-\d{4}$/.test(phone.value);
   let emailValid = /^[\w]+@[a-z]+\.[a-z]{3,5}$/.test(email.value);
   let transact = document.getElementById('transaction');
   let transactSelected = transact.selectedOptions[0];
   let transactText = transactSelected.textContent;
   if (!firstName.value) {
      alert("Receptionist's First Name is missing. Please enter.");
      event.preventDefault();
      first.focus();
   }
   else if (firstName.value && !firstValid) { 
      alert("Invalid First Name. Only alphabetic characters are allowed.");
      event.preventDefault();
      first.focus();
   }
   else if (!lastName.value) {
      alert("Receptionist's Last Name is missing. Please enter.");
      event.preventDefault();
      last.focus();
   }
   else if (lastName.value && !lastValid) { 
      alert("Invalid Last Name. Only alphabetic characters are allowed.");
      event.preventDefault();
      last.focus();
   }
   else if (!pass.value) {
      alert("Receptionist's Password is missing. Please enter.");
      event.preventDefault();
      pass.focus();
   }
   else if (pass.value && !passValid) {
      alert("Invalid Password. Must be no longer than 16 characters, and must contain at least 1 uppercase letter, 1 special character (i.e @, $), and 1 number.");
      event.preventDefault();
      pass.focus();
   }
   else if (!id.value) {
      alert("Receptionist's ID # is missing. Please enter.");
      event.preventDefault();
      id.focus();
   }
   else if (id.value && !idValid) {
      alert("Invalid ID #. Must contain a 4-digit number.");
      event.preventDefault();
      id.focus();
   }
   else if (!phone.value) {
      alert("Receptionist's Phone # is missing. Please enter.");
      event.preventDefault();
      phone.focus();
   }
   else if (phone.value && !phoneValid) {
      alert("Invalid Phone #. Must consist of 10 digits in total, 3 digits followed by 3 digits followed by 4 digits, with dash separating the 3 separate pairs of numbers (i.e. 777-777-7777 or 777 777 7777).");
      event.preventDefault();
      phone.focus();
   }
   else if (!email.value && emailConfirm.checked === true) {
      alert("Receptionist's Email is missing. Please enter.");
      event.preventDefault();
      email.focus();
   }
   else if (email.value && emailConfirm.checked === true && !emailValid) {
      alert("Invalid Email. Must contain an @ followed by any number of characters, followed by a period, followed by a domain name that consists of 3-5 characters (i.e. .com, .org, .edu, .gov).");
      event.preventDefault();
      email.focus();
   }
}