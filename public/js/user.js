const $tableID = $('#table');
const newTr = `
                    <tr>
                        <td class="pt-3-half" contenteditable="true"></td>
                        <td class="pt-3-half" contenteditable="true"></td>
                        <td class="pt-3-half" contenteditable="true"></td>
                        <td class="pt-3-half" contenteditable="true"></td>
                        <td class="pt-3-half" contenteditable="true"></td>
                        <td class="pt-3-half" contenteditable="true"></td>
                        <td class="pt-3-half" contenteditable="true"></td>
                        <td class="pt-3-half" contenteditable="true"></td>
                        <td class="pt-3-half" contenteditable="true"></td>
                        <td class="pt-3-half" contenteditable="true"></td>
                        <td class="pt-3-half" contenteditable="true"></td>
                        <td class="pt-3-half">
                            <span class="table-up"><a href="#!" class="indigo-text"><i class="fas fa-unlock"
                                        aria-hidden="true"></i></a></span>
                        </td>
                        <td>
                            <span class="table-remove"><button type="button"
                                    class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>
                        </td>
                    </tr>
`;

const notify = (msg,type) => {
    $('#message').addClass(`alert-${type}`);
    $('#message').html(`<strong> ${msg} </strong>`);
    $('#message').removeClass('fade');
    $('#message').delay(500);
    $('#message').fadeToggle(500);

}
