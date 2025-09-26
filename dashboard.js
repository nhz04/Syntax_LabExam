
function showContent(menuId, link) {
 
  document.querySelectorAll('.content-section').forEach(sec => sec.classList.add('hidden'));

 
  document.querySelectorAll('nav a').forEach(a => {
    a.classList.remove('bg-pink-200', 'text-white', 'hover:bg-gray-200'); // remove background & active text
    a.classList.add('text-pink-700', 'hover:bg-pink-200'); // default text + hover
    //a.classList.remove('bg-pink-200', 'text-white'); 
    //a.classList.add('text-pink-700'); 
  });


  const menu = document.getElementById(menuId);
  if(menu) menu.classList.remove('hidden');

  link.classList.add('bg-pink-200', 'text-white');
  link.classList.remove('text-pink-700');
}

