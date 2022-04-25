Imports gCursorLib
Public Class Form1
    Dim lbldragtype2qus() As Label
    Dim lbldragtype2ans() As Label
    Private Source As Control
    Private HotSpot As ContentAlignment = ContentAlignment.MiddleCenter
    Private TextAlign As ContentAlignment = ContentAlignment.MiddleCenter
    Private TextAutoFit As gCursor.eTextAutoFit = gCursor.eTextAutoFit.Height
    Private TextType As gCursor.eType = gCursor.eType.Both
    Private TextFill As gCursor.eTextFade = gCursor.eTextFade.Solid
    Private TextColor As Color = Color.Black
    Private TextShadowColor As Color = Color.Black
    Private TextBoxColor As Color = Color.LightGray
    Private TextBorderColor As Color = Color.Black
    Private ImageBoxColor As Color = Color.Green
    Private ImageBorderColor As Color = Color.Black
    Private TextFont As New Font("Microsoft Sans Serif", 10)
    Dim dragarrayname() As String
    Dim dragarray() As String
    Dim temp As String = ""

    Private Sub Form1_Load(sender As Object, e As EventArgs) Handles Me.Load
        ReDim dragarrayname(0)
        ReDim dragarray(0)
        create_labeltodispques()
        create_ctlfordragtype2ansoption()
        procto_setlocfor_ctls()
    End Sub
    Private Sub create_labeltodispques()
        Dim i As Integer
        ReDim lbldragtype2qus(12)
        For i = 0 To 9
            lbldragtype2qus(i) = New Label
            lbldragtype2qus(i).Name = "lbldragtype2qus" & i + 1
            lbldragtype2qus(i).Visible = True
            lbldragtype2qus(i).BorderStyle = BorderStyle.FixedSingle
            lbldragtype2qus(i).AutoSize = True
            lbldragtype2qus(i).Font = New Font("Microsoft Sans Serif", 10, FontStyle.Regular)
            lbldragtype2qus(i).BackColor = Color.LightGray
            lbldragtype2qus(i).Text = "Question" & i + 1
            Panel1.Controls.Add(lbldragtype2qus(i))
            AddHandler lbldragtype2qus(i).MouseDown, AddressOf lbldragtype2qus_mousedown
            AddHandler lbldragtype2qus(i).GiveFeedback, AddressOf lbldragtype2qus_givefeedback
        Next
    End Sub
    Private Sub lbldragtype2qus_mousedown(ByVal sender As Object, ByVal e As System.Windows.Forms.MouseEventArgs)
        Dim lbldrtyp2qus As Label = sender
        With GCursorLabel
            .gText = lbldrtyp2qus.Text
            '.gTextAutoFit = gCursor.eTextAutoFit.All
            .gHotSpot = HotSpot
            .gTextAlignment = TextAlign
            .gTTransp = 0
            .gITransp = 80
            .gTBTransp = 0
            .gTextColor = TextColor
            .gTextShadowColor = TextShadowColor
            .gTextShadower.Font = .gFont
            .gTextShadower.OffsetXY(CSng(2.0 * 0.1))
            .gTextShadower.Blur = CSng(2.0 * 0.1)
            .gTextShadower.ShadowTransp = 128
            .gTextBoxColor = TextBoxColor
            .gTextBorderColor = TextBorderColor
            .gShowTextBox = True
            .gBlackBitBack = False 'True 'CheckBox2.Checked
            .gBoxShadow = False 'True 'CheckBox3.Checked
            .gTextShadow = True ' CheckBox5.Checked
            .gTextFade = TextFill
            .gTextMultiline = True
            .gFont = New Font("Microsoft Sans Serif", 8, CType(FontStyle.Regular, FontStyle))
            .MakeCursor()
        End With
        Source = CType(sender, Control)
        lbldrtyp2qus.DoDragDrop(lbldrtyp2qus, DragDropEffects.Copy)
    End Sub
    Private Sub lbldragtype2qus_givefeedback(ByVal sender As Object, ByVal e As System.Windows.Forms.GiveFeedbackEventArgs)
        e.UseDefaultCursors = False
        'If ((e.Effect And DragDropEffects.Move) = DragDropEffects.Move) Then
        '    Cursor.Current = New Cursor(Me.Icon.Handle)
        'Else
        '    Cursor.Current = System.Windows.Forms.Cursors.Hand   'System.Windows.Forms.Cursors.Default
        'End If
        If ((e.Effect And DragDropEffects.Copy) = DragDropEffects.Copy) Then
            GCursorLabel.gEffect = gCursor.eEffect.Copy
            'Cursor.Current = New Cursor(Me.Icon.Handle)
        Else
            GCursorLabel.gEffect = gCursor.eEffect.No
            'Cursor.Current = System.Windows.Forms.Cursors.Hand
        End If
        Cursor.Current = GCursorLabel.gCursor
    End Sub
    Private Sub create_ctlfordragtype2ansoption()
        'dynamically creates label control for drag type answer options
        Dim i As Integer
        ReDim lbldragtype2ans(12)

        For i = 0 To 9
            lbldragtype2ans(i) = New Label
            lbldragtype2ans(i).Name = "lbldragtype2ans" & i + 1
            lbldragtype2ans(i).Visible = True
            'ToolTip1.SetToolTip(lbldragtype2ans(i), "Please click to view the original content")
            lbldragtype2ans(i).BorderStyle = BorderStyle.FixedSingle
            lbldragtype2ans(i).AutoSize = True
            lbldragtype2ans(i).Font = New Font("Microsoft Sans Serif", 10, FontStyle.Regular)
            lbldragtype2ans(i).BackColor = Color.LightGray
            lbldragtype2ans(i).AllowDrop = True
            lbldragtype2ans(i).Text = "Answer" & i + 1
            dragarray(i) = "Answer" & i + 1
            dragarrayname(i) = lbldragtype2ans(i).Name
            ReDim Preserve dragarray(UBound(dragarray) + 1)
            ReDim Preserve dragarrayname(UBound(dragarrayname) + 1)
            Panel1.Controls.Add(lbldragtype2ans(i))
            AddHandler lbldragtype2ans(i).DragDrop, AddressOf lbldragtype2ans_dragdrop
            AddHandler lbldragtype2ans(i).DragEnter, AddressOf lbldragtype2ans_dragenter
            AddHandler lbldragtype2ans(i).DragOver, AddressOf lbldragtype2ans_dragover
            AddHandler lbldragtype2ans(i).DragLeave, AddressOf lbldragtype2ans_dragleave
            AddHandler lbldragtype2ans(i).MouseDown, AddressOf lbldragtype2ans_mousedown
            AddHandler lbldragtype2ans(i).MouseUp, AddressOf lbldragtype2ans_mouseup
        Next
    End Sub
    Private Sub lbldragtype2ans_dragdrop(ByVal sender As Object, ByVal e As System.Windows.Forms.DragEventArgs)
        Dim lbl As Label = DirectCast(e.Data.GetData(GetType(Label)), Label)
        Dim tempstr As String
        tempstr = lbl.Text
        Dim lbldrtyp2ans As Label = sender
        lbldrtyp2ans.BorderStyle = BorderStyle.FixedSingle
        lbldrtyp2ans.Text = tempstr
        lbldrtyp2ans.Tag = lbl.Tag
        lbldrtyp2ans.BackColor = Color.AliceBlue
    End Sub
    Private Sub lbldragtype2ans_dragleave(ByVal sender As Object, ByVal e As System.Windows.Forms.DragEventArgs)
        Dim lbldrtyp2ans As Label = sender
        If e.Effect = DragDropEffects.None Then
            lbldrtyp2ans.BackColor = Color.LightGray
        End If
    End Sub
    Private Sub lbldragtype2ans_mousedown(ByVal sender As Object, ByVal e As System.Windows.Forms.MouseEventArgs)
        Dim x As Integer
        Dim final As Integer

        For x = 0 To 9
            If lbldragtype2ans(x).Visible = True Then
                If (dragarrayname(x) = sender.name) Then
                    final = x
                End If
            End If
        Next
        temp = sender.text
        sender.text = dragarray(final)
    End Sub
    Private Sub lbldragtype2ans_mouseup(ByVal sender As Object, ByVal e As System.Windows.Forms.MouseEventArgs)
        sender.text = temp
        temp = ""
    End Sub
    Private Sub lbldragtype2ans_dragenter(ByVal sender As Object, ByVal e As System.Windows.Forms.DragEventArgs)
        Dim lbldragtyp2ans As Label = sender
        If e.Data.GetDataPresent(GetType(Label)) Then
            ' There is Label data. Allow copy.
            e.Effect = DragDropEffects.Copy
            lbldragtyp2ans.BorderStyle = BorderStyle.FixedSingle
        Else
            ' There is no Label. Prohibit drop.
            e.Effect = DragDropEffects.None
            lbldragtyp2ans.BackColor = Color.LightGray
        End If

        Dim i As Integer
        For i = 0 To 9
            If lbldragtype2ans(i).Visible = True Then
                If lbldragtype2ans(i).Name = lbldragtyp2ans.Name Then
                    lbldragtype2ans(i).BackColor = Color.AliceBlue 'color.DimGray
                Else
                    If lbldragtype2ans(i).Tag = 0 Then
                        lbldragtype2ans(i).BackColor = Color.LightGray
                    Else
                        lbldragtype2ans(i).BackColor = Color.AliceBlue 'Color.DimGray
                    End If
                    'lbldragtype2ans(i).BackColor = Color.LightGray
                End If
            End If
        Next
    End Sub
    Private Sub lbldragtype2ans_dragover(ByVal sender As Object, ByVal e As System.Windows.Forms.DragEventArgs)

    End Sub
    Private Sub procto_setlocfor_ctls()
        For i = 0 To 9
            If lbldragtype2qus(i).Visible = True Then
                lbldragtype2qus(i).AutoSize = False
                'lbldragtype2qus(i).Size = New Size(mxquswt, mxqusht)
                If i = 0 Then
                    lbldragtype2qus(i).Left = 9
                    lbldragtype2qus(i).Top = 21
                Else
                    lbldragtype2qus(i).Left = lbldragtype2qus(i - 1).Left
                    lbldragtype2qus(i).Top = lbldragtype2qus(i - 1).Top + lbldragtype2qus(i - 1).Height + 10
                End If
            End If
        Next
        For k = 0 To 9
            If lbldragtype2ans(k).Visible = True Then
                lbldragtype2ans(k).AutoSize = False

                If lbldragtype2qus(k).Visible = True Then
                    lbldragtype2ans(k).Left = lbldragtype2qus(k).Left + lbldragtype2qus(k).Width + 100
                Else
                    lbldragtype2ans(k).Left = lbldragtype2qus(0).Left + lbldragtype2qus(0).Width + 100
                End If
                If k = 0 Then
                    lbldragtype2ans(k).Top = lbldragtype2qus(0).Top
                Else
                    lbldragtype2ans(k).Top = lbldragtype2ans(k - 1).Top + lbldragtype2ans(k - 1).Height + 10
                End If
            End If
        Next
    End Sub

End Class
