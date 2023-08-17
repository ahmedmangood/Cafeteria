//**Click On Add Button */
let addCarts = document.querySelectorAll(".card_bottom .btn_card");
console.log(addCarts);
for (let i = 0; i < addCarts.length; i++) {
  addCarts[i].addEventListener("click", function addToCart() {
    addCarts[i].innerHTML = '<i class="fa-solid fa-check"></i>';
  });
}
//*Search on Product
const searchInput = document.getElementById("search-input");
const searchForm = document.getElementById("search-form");
searchInput.addEventListener("input", function () {
  if (searchInput.value === "") {
    // Remove the query string from the URL
    window.history.replaceState({}, document.title, window.location.pathname);
    // searchForm.submit();
    // Set the focus to the input field if it has a value
    searchInput.focus();
    searchForm.submit();
  }
});
