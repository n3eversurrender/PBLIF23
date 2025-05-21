document.addEventListener('DOMContentLoaded', () => {
    const articles = document.querySelectorAll('.text-content');
    const buttons = document.querySelectorAll('.toggle-text');

    // Loop melalui setiap artikel dan tombol
    articles.forEach((article, index) => {
        const fullText = article.textContent.trim();
        const originalHeight = article.offsetHeight;

        // Set teks awal ke versi ringkas
        article.style.display = '-webkit-box';
        article.style.webkitBoxOrient = 'vertical';
        article.style.webkitLineClamp = '7'; // Batas 22 baris
        article.style.overflow = 'hidden';

        // Periksa apakah tinggi melebihi batas
        const truncatedHeight = article.offsetHeight;
        const button = buttons[index];

        if (truncatedHeight >= originalHeight) {
            button.style.display = 'none'; // Sembunyikan tombol jika tidak perlu
        }

        // Event untuk toggle teks
        button.addEventListener('click', () => {
            const isExpanded = article.style.webkitLineClamp === 'none';
            article.style.webkitLineClamp = isExpanded ? '7' : 'none';
            button.textContent = isExpanded ? 'Selengkapnya' : 'Sembunyikan';
        });
    });
});

