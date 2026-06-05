const modal = document.getElementById("modal");
const detailBtn = document.querySelectorAll(".detail-btn");

detailBtn.forEach((button) => {
    button.addEventListener("click", () => {
        modal.style.display = "block";
    });
});
