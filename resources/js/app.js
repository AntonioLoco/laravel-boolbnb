import './bootstrap';
import '~resources/scss/general.scss';
import * as bootstrap from 'bootstrap';
import axios from 'axios';
import.meta.glob([
    '../img/**'
])


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