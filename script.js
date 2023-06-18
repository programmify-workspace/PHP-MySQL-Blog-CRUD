// let blogMenu = document.getElementById("blog-menu");

function toggleBlogMenu() {
    let blogMenu = document.getElementById("blog-menu");
    if (blogMenu.style.display === "none") {
        blogMenu.style.display = "flex";
    } else {
        blogMenu.style.display = "none";
    }
}

if (window.innerWidth > 1000) {
    document.getElementById("blog-menu").style.display = "none";
  }