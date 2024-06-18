// server.js
const express = require('express');
const bodyParser = require('body-parser');
const fetch = require('node-fetch'); // You'll need to install node-fetch package

const app = express();
const PORT = 3000;

app.use(bodyParser.json());
app.use(express.static('public'));

app.post('/get-response', async (req, res) => {
    const userQuery = req.body.query;

    try {
        // Replace with actual API call to fetch data from the internet
        const apiResponse = await fetch(`https://api.example.com/search?q=${encodeURIComponent(userQuery)}`);
        const apiData = await apiResponse.json();

        // Mock response for demonstration
        const mockResponse = apiData.results[0].snippet;

        res.json({ response: mockResponse });
    } catch (error) {
        res.status(500).json({ response: 'Sorry, something went wrong. Please try again later.' });
    }
});

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});
