const btn = document.querySelector("#btnGoToPage");
const inp = document.querySelector("#inputGoToPage");
const form = document.querySelector("#formGoToPage");

const check = () => btn.disabled = inp.value <= 0 || inp.value > Number(MAX_PAGES) || inp.value == ""
inp.addEventListener('input', check);
check();

if (MAX_PAGES == 1) {
    form.innerHTML = ""
}
btn.addEventListener("click", function () {
    const inputes = inp.value;
    const search = location.search
    const id_search = search.substring(0, search.indexOf("&")) ? search.substring(0, search.indexOf("&")) : search;
    const index = "?page=" + inputes;
    const single = "&page=" + inputes;
    if (location.href.substring(0, 23) == "http://movies-phpmysql/") {
        location.href = index;
    }
    if (location.href.substring(23, 39) == "single-genre.php") {
        location.href = id_search + single
    }
    if (location.href.substring(23, 39) == "single-actor.php") {
        location.href = id_search + single
    }
})
