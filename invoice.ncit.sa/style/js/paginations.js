     var table = $('#m_table_1').DataTable({
                "language": {
                    "search": "بحث",
                    "lengthMenu": "عرض _MENU_ صفوف",
                },
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "الكل"]],
                order: [[0, 'desc']],
                initComplete: function () {
                    var column = this.api().column(2);

                    var select = $('<select class="filter "><option value=""></option></select>')
                            .appendTo('#selectTriggerFilter')
                            .on('change', function () {
                                var val = $(this).val();
                                //column.search(val ? '^' + $(this).val() + '$' : val, true, false).draw();
                                column.search(val).draw()
                            });

                    var offices = [];
                    column.data().toArray().forEach(function (s) {
                        s = s.split(',');
                        s.forEach(function (d) {
                            if (!~offices.indexOf(d)) {
                                offices.push(d)
                                select.append('<option value="' + d + '">' + d + '</option>');
                            }
                        })
                    })
                    /*      
                     column.data().unique().sort().each(function(d, j) {
                     select.append('<option value="' + d + '">' + d + '</option>');
                     });a
                     */
                }
            });
