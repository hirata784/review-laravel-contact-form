const modal = document.getElementById("modal");
const detailBtn = document.querySelectorAll(".detail-btn");
const cancelBtn = document.getElementById("modal-cancel-btn");

// 詳細クリックイベント
detailBtn.forEach((button) => {
    button.addEventListener("click", () => {
        modal.style.display = "block";
    });
});

// 閉じるクリックイベント
cancelBtn.addEventListener("click", () => {
    modal.style.display = "none";
});
