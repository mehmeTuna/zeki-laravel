const worker = () => {
    let i = 0;
    setInterval(function() {
        // i++;
        // Sending data to Main
        postMessage(i); // sent data to main app
    }, 30000);
    // Receiving data from Main
    onmessage = event => {
        // console.log(`From main> ${event.data}`);
    };
};

export const myWebWorker = new Blob([`(${worker.toString()})()`], {
    type: "text/javascript"
});
