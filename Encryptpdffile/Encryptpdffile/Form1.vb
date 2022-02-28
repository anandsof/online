Imports System.IO
Imports System.Security.Cryptography

Public Class frmencrypt
    Dim strFileToEncrypt As String
    Dim strFileToDecrypt As String
    Dim strOutputEncrypt As String
    Dim strOutputDecrypt As String
    Dim fsInput As System.IO.FileStream
    Dim fsOutput As System.IO.FileStream
    Private Sub Button1_Click(sender As Object, e As EventArgs) Handles Button1.Click
        encrypt_pdffile()
    End Sub
    Private Sub encrypt_pdffile()
        'Declare variables for the key and iv.
        'The key needs to hold 256 bits and the iv 128 bits.
        Dim bytKey As Byte()
        Dim bytIV As Byte()
        'Send the password to the CreateKey function.
        bytKey = CreateKey("certexam")
        'Send the password to the CreateIV function.
        bytIV = CreateIV("certexam")
        'Start the encryption.
        Dim strfiletoencrypt As String = App_path() & "\A+ Manual.pdf"
        Dim strdestfile As String = App_path() & "\A+ Manual_pdf.encrypt"
        EncryptOrDecryptFile(strfiletoencrypt, strdestfile,
                             bytKey, bytIV, CryptoAction.ActionEncrypt)
        MsgBox("Encrypted")
    End Sub
    Private Function App_path()
        Return My.Application.Info.DirectoryPath
    End Function
    Private Function CreateKey(ByVal strPassword As String) As Byte()
        Dim bytKey As Byte()
        Dim bytSalt As Byte() = System.Text.Encoding.ASCII.GetBytes("salt1234")
        'Dim pdb As New PasswordDeriveBytes(strPassword, bytSalt)
        Dim pdb As New Rfc2898DeriveBytes(strPassword, bytSalt)

        bytKey = pdb.GetBytes(32)

        Return bytKey 'Return the key.
    End Function
    Private Sub EncryptOrDecryptFile(ByVal strInputFile As String, ByVal strOutputFile As String, ByVal bytKey() As Byte, ByVal bytIV() As Byte, ByVal Direction As CryptoAction)

        'Setup file streams to handle input and output.
        fsInput = New System.IO.FileStream(strInputFile, FileMode.Open,
                                              FileAccess.Read)
        fsOutput = New System.IO.FileStream(strOutputFile,
                                               FileMode.OpenOrCreate,
                                               FileAccess.Write)
        fsOutput.SetLength(0) 'make sure fsOutput is empty

        'Declare variables for encrypt/decrypt process.
        Dim bytBuffer(4096) As Byte 'holds a block of bytes for processing
        Dim lngBytesProcessed As Long = 0 'running count of bytes processed
        Dim lngFileLength As Long = fsInput.Length 'the input file's length
        Dim intBytesInCurrentBlock As Integer 'current bytes being processed
        Dim csCryptoStream As CryptoStream = Nothing
        'Declare your CryptoServiceProvider.
        Dim cspRijndael As New System.Security.Cryptography.RijndaelManaged
        'Setup Progress Bar


        'Determine if ecryption or decryption and setup CryptoStream.
        Select Case Direction
            Case CryptoAction.ActionEncrypt
                csCryptoStream = New CryptoStream(fsOutput, cspRijndael.CreateEncryptor(bytKey, bytIV), CryptoStreamMode.Write)

            Case CryptoAction.ActionDecrypt
                csCryptoStream = New CryptoStream(fsOutput, cspRijndael.CreateDecryptor(bytKey, bytIV), CryptoStreamMode.Write)
        End Select

        'Use While to loop until all of the file is processed.
        While lngBytesProcessed < lngFileLength
            'Read file with the input filestream.
            intBytesInCurrentBlock = fsInput.Read(bytBuffer, 0, 4096)
            'Write output file with the cryptostream.
            csCryptoStream.Write(bytBuffer, 0, intBytesInCurrentBlock)
            'Update lngBytesProcessed
            lngBytesProcessed = lngBytesProcessed +
                                    CLng(intBytesInCurrentBlock)
            'Update Progress Bar
            ' pbStatus.Value = CInt((lngBytesProcessed / lngFileLength) * 100)
        End While

        'Close FileStreams and CryptoStream.
        csCryptoStream.Close()
        fsInput.Close()
        fsOutput.Close()
    End Sub
    Private Function CreateIV(ByVal strPassword As String) As Byte()
        Dim bytIV As Byte()
        Dim bytSalt As Byte() = System.Text.Encoding.ASCII.GetBytes("salt1234")
        ' Dim pdb As New PasswordDeriveBytes(strPassword, bytSalt)
        Dim pdb As New Rfc2898DeriveBytes(strPassword, bytSalt)

        bytIV = pdb.GetBytes(16)

        Return bytIV 'Return the IV.
    End Function
    Private Enum CryptoAction
        'Define the enumeration for CryptoAction.
        ActionEncrypt = 1
        ActionDecrypt = 2
    End Enum
End Class
