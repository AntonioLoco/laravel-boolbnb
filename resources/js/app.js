import './bootstrap';
import '~resources/scss/general.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);
import "./imgPreview";


//Delete btn
//By clicking the delete btn on the index, prevent the default elimination
// open the Modal insert in the view-partials and REactivate the delete by clicking the btn 
const deleteBtns = document.querySelectorAll(".delete-btn");

deleteBtns.forEach((btn) => {
    btn.addEventListener("click", (event) => {
        event.preventDefault();
        const apartmentTitle = btn.getAttribute("data-apartment-title");
        const modal = new bootstrap.Modal(
            document.getElementById("deleteModal")
        );
        document.getElementById("modal-apartment-title").innerText = apartmentTitle;
        document.getElementById("delete").addEventListener("click", () => {
            btn.parentElement.submit();
        });
        modal.show();
    });
});

//Modal Payment
const paymentModal = new bootstrap.Modal(document.getElementById('payment-modal'));
const btnPay = document.getElementById("btn-pay");
const radioSponsorshipButton = document.getElementsByName('sponsorships_value');

btnPay.addEventListener("click", function() {
    let isChecked = false;

    for (let i = 0; i < radioSponsorshipButton.length; i++) {
        if (radioSponsorshipButton[i].checked) {
            isChecked = true;
            break;
        }
    }
    if (isChecked === true) {
        paymentModal.show();
    }
});


radioSponsorshipButton.forEach( radioBtn => {
    radioBtn.addEventListener("click", function(){
        if((btnPay.className).includes("disabled")){
            btnPay.classList.remove("disabled");
        }
    })
})