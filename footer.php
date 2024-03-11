<!-- footer -->
<footer>
      
        <!-- Scripts________________________________________________________ -->
        <script>
        function saveAsPDF() {
            // Get the content section element
            const contentSection = document.getElementById('contentSection');
            const resultSection = document.querySelector('.results-container');
            resultSection.classList.remove('results-container');
            
       

            // Create a configuration object for html2pdf
            var opt = {
            margin:       0,
            filename:     'accountPlanner.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 1,scrollY: 0 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' },
            pagebreak: { mode: 'avoid-all', before: '.result-section.conclusion' }
            };

            // New Promise-based usage:
            html2pdf().set(opt).from(contentSection).save();
        }
    </script>

        <!-- Scripts________________________________________________________ -->
        <?php wp_footer(); ?>
    </body>
</html>