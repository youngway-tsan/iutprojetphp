<html>
    <body>
        <form>
        <select id="select1">
            <option value="option1">Option 1</option>
            <option value="option2">Option 2</option>
            <option value="option3">Option 3</option>
            <option value="option4">Option 4</option>
        </select>
        <select id="select2"></select>
        </form>

        <script>
            var select1 = document.getElementById("select1");
            var select2 = document.getElementById("select2");

            select1.addEventListener("change", function() {
                var selectedOption = select1.options[select1.selectedIndex].value;
                var options = select1.querySelectorAll("option");

                select2.innerHTML = "";
                for (var i = 0; i < options.length; i++) {
                    if (options[i].value !== selectedOption) {
                        select2.innerHTML += "<option value='" + options[i].value + "'>" + options[i].text + "</option>";
                    }
                }
            });
        </script>
    </body>
</html>