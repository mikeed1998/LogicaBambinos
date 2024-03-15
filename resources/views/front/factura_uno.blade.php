<style>

    table {
        border: 1px solid transparent;
        border-collapse: collapse;
    }

    tr {
        padding: 0; /* Elimina el espacio interno (padding) de las celdas */
        margin: 0; /* Elimina el espacio externo (margin) de las celdas */
    }

    td {
        border: 1px solid #B8CEE9;
    }

</style>

<table style="margin-top: 10px; margin-left: auto; margin-right: auto;">
    <tr>
        <td rowspan="6" style="padding-left: 10px; padding-right: 10px; border: 0;">
            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAUcAAACHCAYAAACF1ptrAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAB3fSURBVHhe7Z131BTFmof379117727V71GREURRUXMYsCAYsCEEbOIYgQTJsyIIoooxisoKEFBzIqiKIKImBAjBgSUoCIGlCBi73maamyat2Y6VE/PN/M+5/wOh29qenp6un5d4a23/sNTFEVRVkHNUVEURUDNUVEURUDNUVEURUDNUVEURUDNUVEURcCpOc6eM9e76PKrvZNPP9d7dtRo81clb76ZNdu74pqe3qmdu3iPP/Ws+auiKFlwZo7zf/zJa9yspfef/1x/hfoPHGxeVfLiu+/neU1b7LzSdb9vwCDzqqIoaXFmjrfdee9KFRT9z7829CZMnGRKKK5ZunSp16bdEatc90233slbtmyZKaUoShqcmWOLnfZcpZKiDTbbxps1e44ppbika7fu4jVHL73ymimlKEoanJjjG2++JVbQQK32PtBbvHixKa24YODgR8RrHei4UzubkoqipMGJOZ5x7oViBQ2r09nnm9JKVt565z3v72tvLF7nQH9bayNv3g/zzTsURUlKZnNcsOBXb/VGTcUKGtWd9/Y371LSMmfut95GW2wnXt+o+t2j11tR0pLZHB94aKhYMSWttmZjb+z4CeadSlKWLFnitW57qHhtJW236z7mnYqiJCWzOe6x3yFixbRpvU228mbM/Nq8W0nC2edfIl7TUnr73cnm3YqiJCGTOX4y9TOxQpbTTq3begsXLjJHUeJw/4MPi9eynDBURVGSk8kcL+l+nVgh4+ikTueYoyjlIFaUmFHpOpbTmhs08377baE5kqIocUltjr///ru3/qZbixUyrvr0u8ccTbFBjCixotL1i6uHh40wR1MUJS6pzZE1vFJFTKL/XmMDDVYuAbGhxIhK1y6J9j7wcHNERVHiktocDznqBLEiJtU6Gzf3pn01wxxVCUNsqHTN0uizz780R1UUJQ6pzJEsMP+1eiOxEqYRISe//vqbOboCxIRK1yqtyNqjKEp8Upljz959xQqYRceefIY5ukIsKDGh0nVKKzImkahCUZR4JDbHP//809tsm13ECphVN95yu/mU+oUYUGJBpeuTVc88/6L5FEVRypHYHF95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" style="width: 110px; height: 45px;" />
        </td>
    </tr>
    <tr>
        <td rowspan="5" style="padding-left: 5px; padding-right: 5px; border: 0;"></td>
        <td style="font-weight: 800; font-size: 10px; border: 0; padding-top: 0;">Brincolines Bambinos S.A. de C.V.</td>
        <td rowspan="5" style="padding-left: 50px; padding-right: 50px; border: 0;"></td>
        <td rowspan="3" style="padding-left: 10px; padding-right: 10px; text-align: center; font-weight: 700; font-size: 28px; text-align: center; border-bottom: 0;">Pedido</td>
        <td rowspan="3" style="padding-left: 70px; padding-right: 70px; text-align: center; font-weight: 700; font-size: 32px; background-color: #F1F4FF; color: #F15F90;">-W</td>
    </tr>
    <tr>
        <td style="font-size: 10px; border: 0; padding-top: 0;">Bosque de la Primavera 13, Puerta del </td>
     </tr>
    <tr>
        <td style="font-size: 10px; border: 0; padding-top: 0;">bosque Zapopan, Jal. C.P. 45066</td>
    </tr>
    <tr>
        <td style="font-size: 10px; border: 0; padding-top: 0;">Tel. (33) 1654 5229</td>
        <td rowspan="2" style="padding-left: 20px; padding-right: 20px; text-align: center; font-size: 10px; border-top: 0;">Fecha</td>
        <td rowspan="2" style="padding-left: 20px; padding-right: 20px; text-align: center; font-size: 10px; background-color: #F1F4FF;">Fecha</td>
    </tr>
    <tr>
        <td style="font-size: 10px; border: 0;">Tel. (33) 1991 0883 / (33) 2078 7337</td>
    </tr>

</table>

<table style="margin: 20px auto;">
    <tr>
        <td colspan="6" style="text-align: center; font-size: 22px; font-weight: 700; border: 0;">
            Orden de compra
        </td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 16px; font-weight: 700;">Datos del Cliente</td>
    </tr>
    <tr style="color: #9DA1A5;">
        <td style="font-size: 12px; width: 80px; text-align: center; border-bottom: 0;">Nombre</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 225px; text-align: left;"></td>
        <td style="font-size: 12px; width: 80px; text-align: center; border-bottom: 0;">No. Cliente</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: left;"></td>
        <td style="font-size: 12px; width: 80px; text-align: center; border-bottom: 0;">Teléfono</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: left;"></td>
    </tr>
    <tr style="color: #9DA1A5;">
        <td style="font-size: 12px; width: 80px; text-align: center; border-top: 0; border-bottom: 0;">Domicilio</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 225px; text-align: left;"></td>
        <td style="font-size: 12px; width: 80px; text-align: center; border-top: 0; border-bottom: 0;">Colonia</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: left;"></td>
        <td style="font-size: 12px; width: 80px; text-align: center; border-top: 0; border-bottom: 0;">Código Postal</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: left;"></td>
    </tr>
    <tr style="color: #9DA1A5;">
        <td style="font-size: 12px; width: 80px; text-align: center;border-top: 0; border-bottom: 0;">Ciudad</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 225px; text-align: left;"></td>
        <td style="font-size: 12px; width: 80px; text-align: center; border-top: 0; border-bottom: 0;">Estado</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: left;"></td>
        <td style="font-size: 12px; width: 80px; text-align: center; border-top: 0; border-bottom: 0;">País</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: left;"></td>
    </tr>
    <tr style="color: #9DA1A5;">
        <td style="font-size: 12px; width: 80px; text-align: center; border-top: 0; border-bottom: 0;">RFC</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 225px; text-align: left;"></td>
        <td style="font-size: 12px; width: 80px; text-align: center; border-top: 0; border-bottom: 0;">Correo</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 225px; text-align: left;" colspan="3"></td>
    </tr>
    <tr style="color: #9DA1A5;">
        <td style="font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;">Paquetería</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 225px; text-align: left;"></td>
        <td style="font-size: 12px; width: 80px; text-align: center; border-top: 0;">Tipo de envió</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: left;"></td>
        <td style="font-size: 12px; width: 80px; text-align: center; border-top: 0;">Asesor</td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: left;"></td>
    </tr>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 16px; font-weight: 700;">Pedido</td>
    </tr>
    <tr style="color: #9DA1A5;">
        <td style="border-right: 0; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;">Cant</td>
        <td colspan="2" style="border-left: 0; border-right: 0; font-size: 12px; width: 305px; text-align: center;">Juego</td>
        <td style="border-left: 0; border-right: 0; font-size: 12px; width: 100px; text-align: center;">Medida</td>
        <td style="border-left: 0; border-right: 0; font-size: 12px; width: 80px; text-align: center; border-top: 0;">Precio Unitario</td>
        <td style="border-left: 0; font-size: 12px; width: 100px; text-align: center;">Importe</td>
    </tr>
    <!-- Ciclo for con cada producto //-->
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr style="color: #000000;">
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center;border-top: 0; border-top: 0;"></td>
        <td colspan="2" style="background-color: #F1F4FF; font-size: 12px; width: 305px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 80px; text-align: center; border-top: 0;"></td>
        <td style="background-color: #F1F4FF; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr>
        <td colspan="3" style="font-size: 12px; width: 80px; font-weight: 700; text-align: center;border-top: 0; border-top: 0; color: #9DA1A5;">Tu pedido incluye</td>
        <td style="font-size: 12px; width: 100px; text-align: center; border: 0;"></td>
        <td style="font-size: 12px; width: border-bottom: 0; 80px; text-align: center; border-bottom: 0; border-top: 0; color: #9DA1A5;">Precio paquete</td>
        <td style="background-color: #F1F4FF; border-bottom: 0; font-size: 12px; width: 100px; text-align: center;">$ 0.00</td>
    </tr>
    <tr>
        <td rowspan="6" colspan="3" style="background-color: #F1F4FF;"></td>
    </tr>

    <tr>
        <td rowspan="5" style=" border: 0;"></td>
        <td style="border-top: 0; border-bottom: 0; font-size: 12px; padding-top: 0;  text-align: center; color: #9DA1A5;">Deducción</td>
        <td style="background-color: #F1F4FF; text-align: center; font-size: 12px; "></td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0; font-size: 12px; padding-top: 0; text-align: center; color: #9DA1A5;">I.V.A.</td>
        <td style="background-color: #F1F4FF; text-align: center; font-size: 12px;"></td>
     </tr>
    <tr>
        <td style="border-top: 0; font-size: 12px; padding-top: 0; text-align: center; color: #9DA1A5;">Total</td>
        <td style="background-color: #F1F4FF; font-size: 12px; text-align: center;">$ 0.00</td>
    </tr>
    <tr>
        <td style="border-top: 0; border-bottom: 0; font-size: 12px; padding-top: 0; text-align: center; color: #9DA1A5;">Anticipo</td>
        <td style="background-color: #F1F4FF; text-align: center; font-size: 12px;"></td>
    </tr>
    <tr>
        <td style="border-top: 0; font-size: 12px; text-align: center; color: #9DA1A5;">Saldo</td>
        <td style="background-color: #F1F4FF; text-align: center; font-size: 12px;">$ 0.00</td>
    </tr>
    <tr>
        <td colspan="3" style="font-size: 12px; width: 80px; font-weight: 700; text-align: center; border-top: 0; border-top: 0; color: #9DA1A5;">Tu pedido incluye</td>
        <td colspan="3" rowspan="2" style="font-weight: 700; font-size: 12px; width: 100px; text-align: center; border-bottom: 0;">Para comenzar la producción de su pedido se requiere un anticipo de</td>
    </tr>
    <tr>
        <td rowspan="4" colspan="3" style="background-color: #F1F4FF;"></td>
    </tr>
    <tr>
        <td colspan="3" rowspan="1" style="text-align: center; font-size: 12px; background-color: #F1F4FF;">
            $ 0.00
        </td>
    </tr>
    <tr>
        <td colspan="3" rowspan="1" style="text-align: center; font-size: 12px; font-weight: 700;">
            Tiempo de entrega aproximado
        </td>
    </tr>
    <tr>
        <td colspan="3" rowspan="1" style="color: #F1609B; font-weight: bold; text-align: center; font-size: 12px; background-color: #F1F4FF;">
            4 a 7 semanas
        </td> 
    </tr>
    
    <tr>
        <td colspan="6" style="font-size: 12px; border: 0;"><br>Te recomendamos revisar nuestras políticas comerciales al final de tu orden de compra.</td>
    </tr>
</table>



{{-- <td colspan="6">Te recomendamos revisar nuestras políticas comerciales al final de tu órden de compra.</td> --}}
