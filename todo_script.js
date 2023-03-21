
//Title of List
document.querySelector('.list-name').addEventListener("click", () => {
    document.querySelector('.list-name').contentEditable = "true";
    document.querySelector('.list-name').addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            document.querySelector('.list-name').contentEditable = "false";
        }
    });
});
