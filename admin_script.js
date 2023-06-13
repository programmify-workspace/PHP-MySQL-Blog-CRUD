document.querySelectorAll('.show-posts .box-container .box .post-content').forEach(content => {
    if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
 });

