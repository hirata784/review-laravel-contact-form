const modal = document.getElementById("modal");
const detailBtn = document.querySelectorAll(".detail-btn");
const cancelBtn = document.getElementById("modal-cancel-btn");
const hidden = document.getElementById("modal-hidden");
// 詳細データ表示
const tdName = document.getElementById("td-name");
const tdGender = document.getElementById("td-gender");
const tdEmail = document.getElementById("td-email");
const tdTel = document.getElementById("td-tel");
const tdAddress = document.getElementById("td-address");
const tdBuilding = document.getElementById("td-building");
const tdCategory = document.getElementById("td-category");
const tdDetail = document.getElementById("td-detail");

// 詳細クリックイベント
detailBtn.forEach((button) => {
    button.addEventListener("click", function () {
        // 詳細データ取得
        let targetId = this.dataset.target;
        tdName.textContent =
            tableData[targetId]["last_name"] +
            " " +
            tableData[targetId]["first_name"];
        tdGender.textContent = tableData[targetId]["gender"];
        tdEmail.textContent = tableData[targetId]["email"];
        tdTel.textContent = tableData[targetId]["tel"];
        tdAddress.textContent = tableData[targetId]["address"];
        tdBuilding.textContent = tableData[targetId]["building"];
        tdCategory.textContent = tableData[targetId]["category"];
        tdDetail.textContent = tableData[targetId]["detail"];
        // データ削除用idをhiddenで作成
        hidden.value = tableData[targetId]["id"];
        // モーダル表示
        modal.style.display = "block";
    });
});

// 閉じるクリックイベント
cancelBtn.addEventListener("click", () => {
    modal.style.display = "none";
});
