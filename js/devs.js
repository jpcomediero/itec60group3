document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.tab-header-item');
    const contents = document.querySelectorAll('.tab-content-item');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            const target = document.getElementById(tab.dataset.tab);

            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            contents.forEach(content => content.classList.remove('active'));
            target.classList.add('active');
        });
    });
});
