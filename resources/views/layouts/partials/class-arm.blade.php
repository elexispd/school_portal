<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cache selectors
            var $classSelect = $('#class');
            var $classArmSelect = $('#classarm');

            $classSelect.change(function() {
                var classId = $(this).val();

                // Clear and disable class arm select while loading
                $classArmSelect.empty()
                            .append($('<option>', {
                                value: '',
                                text: 'Loading...',
                                disabled: true
                            }))
                            .prop('disabled', true);

                if (classId) {
                    $.ajax({
                        url: "{{ url('/classarms/by-class') }}/" + classId,
                        method: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $classArmSelect.empty()
                                        .append($('<option>', {
                                            value: '',
                                            text: '',
                                            disabled: true,
                                            selected: true
                                        }));

                            // Process response data
                            if (Array.isArray(data)) {
                                data.forEach(function(item) {
                                    $classArmSelect.append($('<option>', {
                                        value: item.id || item,
                                        text: item.name || item
                                    }));
                                });
                            } else if (typeof data === 'object') {
                                Object.keys(data).forEach(function(key) {
                                    $classArmSelect.append($('<option>', {
                                        value: key,
                                        text: data[key]
                                    }));
                                });
                            }

                            // Enable select and set old value
                            $classArmSelect.prop('disabled', false);

                            @if(old('classarm'))
                                $classArmSelect.val("{{ old('classarm') }}");
                            @endif
                        },
                        error: function() {
                            $classArmSelect.empty()
                                        .append($('<option>', {
                                            value: '',
                                            text: 'Error loading class arms',
                                            disabled: true
                                        }));
                        }
                    });
                } else {
                    $classArmSelect.empty()
                                .append($('<option>', {
                                    value: '',
                                    text: 'Select Class Arm',
                                    disabled: true
                                }));
                }
            });

            @if(old('class'))
                $classSelect.trigger('change');
            @endif
        });
    </script>
