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
        // 現在のURLのパラメータを取得
        const urlParams = new URLSearchParams(window.location.search);
        // "page" という名前のパラメータを取得（例: ?page=3 なら "3"）
        let currentPageStr = urlParams.get("page");
        // currentPageStrが空白の場合、1を取得
        currentPageStr = currentPageStr == null ? 1 : currentPageStr;

        // 詳細データ取得(クリックした行 + (7 * (現在のページ - 1)))
        const targetId =
            parseInt(this.dataset.target) + parseInt(7 * (currentPageStr - 1));

        tdName.textContent =
            tableData.data[targetId]["last_name"] +
            " " +
            tableData.data[targetId]["first_name"];
        tdGender.textContent = tableData.data[targetId]["gender"];
        tdEmail.textContent = tableData.data[targetId]["email"];
        tdTel.textContent = tableData.data[targetId]["tel"];
        tdAddress.textContent = tableData.data[targetId]["address"];
        tdBuilding.textContent = tableData.data[targetId]["building"];
        tdCategory.textContent = tableData.data[targetId]["category"];
        tdDetail.textContent = tableData.data[targetId]["detail"];
        // データ削除用idをhiddenで作成
        hidden.value = tableData.data[targetId]["id"];
        // モーダル表示
        modal.style.display = "block";
    });
});

// 閉じるクリックイベント
cancelBtn.addEventListener("click", () => {
    modal.style.display = "none";
});
