function updateDateTime() {
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        timeZone: 'Asia/Jakarta'
    };
    const now = new Date();
    const formattedDate = new Intl.DateTimeFormat('id-ID', options).format(now);


    document.getElementById('datetime').textContent = formattedDate;
}


setInterval(updateDateTime, 1000);


updateDateTime();