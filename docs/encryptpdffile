**Encrypt PDF File Example in VB.net**

Encrypting a PDF document protects its content from unauthorized access. Confidential PDF documents can be encrypted and protected with a password. Only people who know the password will be able to decrypt, open and view those documents. 

Encrypting a PDF document protects its content from unauthorized access.

Confidential PDF documents can be encrypted and protected with a password. Only people who know the password will be able to decrypt, open and view those documents.

Encrypting PDF is a way people commonly used to protect PDF. Whether for a company or for individual, using PDF encryption to place some certain restrictions is indispensable. In order to make the PDF document available to read but unable to modify by unauthorized users, two passwords are required for an encrypted PDF document: owner password and user password. This section will particularly introduce a simple solution to quickly encrypt PDF with C#, VB.NET via Spire.PDF for .NET.
The following code example uses the Rfc2898DeriveBytes class to create two identical keys for the Aes class. It then encrypts and decrypts some data using the keys.
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

   
Rfc2898DeriveBytes takes a password, a salt, and an iteration count, and then generates keys through calls to the GetBytes method.
RFC 2898 includes methods for creating a key and initialization vector (IV) from a password and salt. You can use PBKDF2, a password-based key derivation function, to derive keys using a pseudo-random function that allows keys of virtually unlimited length to be generated. The Rfc2898DeriveBytes class can be used to produce a derived key from a base key and other parameters. In a password-based key derivation function, the base key is a password and the other parameters are a salt value and an iteration count.
For more information about PBKDF2, see RFC 2898, titled "PKCS #5: Password-Based Cryptography Specification Version 2.0". See section 5.2, "PBKDF2," for complete details.

In the above example button click event encrypt_pdffile() procedure is called which encrpts the PDF file name as passed to string variable, you can change the file name of yours

ex: 'Start the encryption.
  Dim strfiletoencrypt As String = App_path() & "\A+ Manual.pdf"     source file nam
  Dim strdestfile As String = App_path() & "\A+ Manual_pdf.encrypt"  destination file name


