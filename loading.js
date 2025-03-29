document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        hideLoading();
    }, 700); // 1 วินาที
});

function showLoading() {
    document.getElementById("loading-overlay").style.display = "flex";
}

function hideLoading() {
    document.getElementById("loading-overlay").style.display = "none";
}

window.addEventListener("beforeunload", function () {
    showLoading();
});

window.addEventListener("unload", function () {
    showLoading();
    // ตัวอย่าง: ข้อความที่จะแสดงในป๊อปอัพ
    // event.returnValue = "Changes you made may not be saved.";
});
