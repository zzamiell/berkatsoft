$(document).ready(function () {

    $('#tambah-ini').click(function () {
        console.log('ini itu');
        $('#valuenya').append(`
        <tr>
            <td><input type="text" name="efek_potensi[]" placeholder=""></td>
            <td><input type="text" name="nilai_s[]" placeholder="S"></td>
            <td><input type="text" name="penyebab_potensi[]" placeholder=""></td>
            <td><input type="text" name="nilai_o[]" placeholder="O"></td>
            <td><input type="text" name="sistem_deteksi[]" placeholder=""></td>
            <td><input type="text" name="nilai_d[]" placeholder="D"></td>  
        </tr>
        `);
    });

});