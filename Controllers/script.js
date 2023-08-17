//----------------------------------------MyCart Page Functions----------------------------------------//
const Notes = document.getElementsByTagName("textarea")[0],
  lineNumbers = document.querySelector(".line-numbers");

let numberOfLines = 0;
//check if the textarea contains note or not
if (Notes) {
  numberOfLines = Notes.value.split("\n").length - 1;
  for (let i = 0; i < numberOfLines; i++) {
    numberLines();
  }

  Notes.addEventListener("keyup", (event) => {

    if (event.keyCode === 13) {
      numberOfLines = event.target.value.split("\n").length;
      if (numberOfLines < 150) numberLines();
    }
  });

  Notes.addEventListener("keydown", (event) => {
    console.log(event)
    if (event.key === "Tab") {
      const start = Notes.selectionStart;
      const end = Notes.selectionEnd;

      Notes.value =
        Notes.value.substring(0, start) + "\t" + Notes.value.substring(end);

      event.preventDefault();
    }
  });

}

//function to open|close sidebar 
function Open_Close_Nav() {
  const sidebar_btn = document.getElementsByClassName("sidebarbtn")[0];
  if (sidebar_btn.classList.contains('openbtn')) {
    sidebar_btn.style.left = "390px";
    sidebar_btn.classList.replace('openbtn', 'closebtn')
    document.getElementById("mySidebar").style.width = "390px";
    document.getElementById("main").style.marginLeft = "390px";
  }
  else if (sidebar_btn.classList.contains('closebtn')) {
    sidebar_btn.style.left = "0";
    sidebar_btn.classList.replace('closebtn', 'openbtn')
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }
}
//function to create newlines
function numberLines() {
  lineNumbers.innerHTML = Array(numberOfLines).fill("<span></span>").join("");
}
//function to save written notes
function savenotes(id) {
  if (Notes.value.length > 0) {
    fetch("../Controllers/cart_controller.php", {
      method: "UPDATE",
      headers: {
        "Content-Type": "application/json;charset=utf-8",
      },
      body: JSON.stringify({ notes: Notes.value, user_id: id }),
    });
    location.reload();
  }
}
//function to increase the quantity of the product
function incrementquantity(availablequantity, product_id, user_id, product_price) {
  span = document.getElementById(product_id);
  span2 = document.getElementById(`prod${product_id}price`);

  counter = span.innerHTML;

  quantity = Number(counter) + 1;
  product_price *= quantity;

  if (counter < availablequantity && product_price < 5000) {
    fetch("../Controllers/cart_controller.php", {
      method: "UPDATE",
      headers: { "Content-Type": "application/json;charset=utf-8" },
      body: JSON.stringify({
        quantity: quantity,
        user_id: user_id,
        product_id: product_id,
        price: product_price,
      }),
    })
    span.innerHTML = quantity;
    span2.innerHTML = product_price.toFixed(2) + ' EGP';
  }
}
//function to decrease the quantity of the product
function decrementquantity(product_id, user_id, product_price) {
  span = document.getElementById(product_id);
  span2 = document.getElementById(`prod${product_id}price`);

  counter = span.innerHTML;

  quantity = Number(counter) - 1;

  product_price *= quantity;

  if (counter > 1) {
    fetch("../Controllers/cart_controller.php", {
      method: "UPDATE",
      headers: { "Content-Type": "application/json;charset=utf-8" },
      body: JSON.stringify({
        quantity: quantity,
        user_id: user_id,
        product_id: product_id,
        price: product_price,
      }),
    })
    span.innerHTML = quantity;
    span2.innerHTML = product_price.toFixed(2) + ' EGP';
  }
}
//function to remove cart
function removecart(id) {
  popup = document.getElementsByClassName("popupscreen");
  popup[0].style = "display:flex";
  res = "";
  btns = document.getElementsByClassName("popbtn");
  for (const btn of btns) {
    btn.addEventListener("click", () => {
      res = btn.innerHTML;
      if (res == "ok") {
        fetch("../Controllers/cart_controller.php", {
          method: "DELETE",
          headers: { "Content-Type": "application/json;charset=utf-8" },
          body: JSON.stringify({ cartid: id }),
        });
        popup[0].style = "display:none";
        location.reload();
      } else if (res == "cancle") {
        popup[0].style = "display:none";
      }
    });
  }
}
//function to create order
function createorder(userid) {
  fetch("../Controllers/cart_controller.php", {
    method: "POST",
    headers: { "Content-Type": "application/json;charset=utf-8" },
    body: JSON.stringify({ user_id: userid }),
  });
  location.reload();
}
//----------------------------------------Products Page Functions----------------------------------------//
function addToCart(e, product_id, product_price, user_id) {
  e.preventDefault();
  fetch("../../Controllers/cart_controller.php", {
    method: "POST",
    headers: { "Content-Type": "application/json;charset=utf-8" },
    body: JSON.stringify({
      usrid: user_id,
      productid: product_id,
      price: product_price,
    }),
  })
}
//----------------------------------------Admin HomePage Functions----------------------------------------//
const canvas = document.querySelector('canvas');


if (canvas != null) {
  const ctx = canvas.getContext('2d');
  ctx.beginPath();
  ctx.moveTo(0, 0);
  ctx.lineTo(0, 500);
  ctx.lineTo(canvas.width, 500);
  ctx.lineWidth = 5;
  ctx.strokeStyle = "black";

  ctx.stroke();

  stopped_at_y = 500;
  stopped_at_x = canvas.width;

  arc_stopped_at_y = 500;
  arc_stopped_at_x = 0;

  for (i = 0; i < 6; i++) {
    ctx.beginPath();
    ctx.moveTo(canvas.width, stopped_at_y -= 80);
    ctx.lineTo(0, stopped_at_y -= -0);
    ctx.lineWidth = 1;
    ctx.strokeStyle = "#d8d8d8";

    ctx.stroke();
    ctx.beginPath();

    ctx.arc(arc_stopped_at_x += 100, arc_stopped_at_y -= 80, 10, 0, 2 * Math.PI);
    ctx.fillStyle = `rgba(100,100,${Math.random() * 255})`
    ctx.fill()
    ctx.stroke();

  }
  for (i = 0; i < 3; i++) {

    ctx.beginPath();

    ctx.arc(arc_stopped_at_x += 100, arc_stopped_at_y += 80, 10, 0, 2 * Math.PI);
    ctx.fillStyle = `rgba(100,100,${Math.random() * 255})`
    ctx.fill()
    ctx.stroke();
  }
  var grad = ctx.createLinearGradient(100, 900, 900, 1000);
  grad.addColorStop(0, "purple");
  grad.addColorStop(1, "green");

  ctx.beginPath();


  ctx.moveTo(100, 420);
  ctx.lineTo(590, 25);

  ctx.moveTo(600, 15);
  ctx.lineTo(900, 260);
  ctx.lineWidth = 1;
  ctx.strokeStyle = grad;
  ctx.stroke();
}

