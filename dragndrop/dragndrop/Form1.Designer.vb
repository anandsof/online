<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Form1
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Me.components = New System.ComponentModel.Container()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(Form1))
        Dim TextShadower3 As gCursorLib.TextShadower = New gCursorLib.TextShadower()
        Me.TableLayoutPanel1 = New System.Windows.Forms.TableLayoutPanel()
        Me.Panel1 = New System.Windows.Forms.Panel()
        Me.GCursorLabel = New gCursorLib.gCursor(Me.components)
        Me.TableLayoutPanel1.SuspendLayout()
        Me.SuspendLayout()
        '
        'TableLayoutPanel1
        '
        Me.TableLayoutPanel1.ColumnCount = 1
        Me.TableLayoutPanel1.ColumnStyles.Add(New System.Windows.Forms.ColumnStyle(System.Windows.Forms.SizeType.Percent, 50.0!))
        Me.TableLayoutPanel1.Controls.Add(Me.Panel1, 0, 0)
        Me.TableLayoutPanel1.Dock = System.Windows.Forms.DockStyle.Fill
        Me.TableLayoutPanel1.Location = New System.Drawing.Point(0, 0)
        Me.TableLayoutPanel1.Name = "TableLayoutPanel1"
        Me.TableLayoutPanel1.RowCount = 1
        Me.TableLayoutPanel1.RowStyles.Add(New System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 50.0!))
        Me.TableLayoutPanel1.Size = New System.Drawing.Size(371, 380)
        Me.TableLayoutPanel1.TabIndex = 0
        '
        'Panel1
        '
        Me.Panel1.Dock = System.Windows.Forms.DockStyle.Fill
        Me.Panel1.Location = New System.Drawing.Point(3, 3)
        Me.Panel1.Name = "Panel1"
        Me.Panel1.Size = New System.Drawing.Size(365, 374)
        Me.Panel1.TabIndex = 0
        '
        'GCursorLabel
        '
        Me.GCursorLabel.gBlackBitBack = False
        Me.GCursorLabel.gBoxShadow = True
        Me.GCursorLabel.gCursorImage = CType(resources.GetObject("GCursorLabel.gCursorImage"), System.Drawing.Bitmap)
        Me.GCursorLabel.gEffect = gCursorLib.gCursor.eEffect.No
        Me.GCursorLabel.gFont = New System.Drawing.Font("Arial", 10.0!, System.Drawing.FontStyle.Bold)
        Me.GCursorLabel.gHotSpot = System.Drawing.ContentAlignment.MiddleCenter
        Me.GCursorLabel.gIBTransp = 80
        Me.GCursorLabel.gImage = Nothing
        Me.GCursorLabel.gImageBorderColor = System.Drawing.Color.Black
        Me.GCursorLabel.gImageBox = New System.Drawing.Size(75, 56)
        Me.GCursorLabel.gImageBoxColor = System.Drawing.Color.White
        Me.GCursorLabel.gITransp = 0
        Me.GCursorLabel.gScrolling = gCursorLib.gCursor.eScrolling.No
        Me.GCursorLabel.gShowImageBox = False
        Me.GCursorLabel.gShowTextBox = False
        Me.GCursorLabel.gTBTransp = 80
        Me.GCursorLabel.gText = ""
        Me.GCursorLabel.gTextAlignment = System.Drawing.ContentAlignment.TopCenter
        Me.GCursorLabel.gTextAutoFit = gCursorLib.gCursor.eTextAutoFit.None
        Me.GCursorLabel.gTextBorderColor = System.Drawing.Color.Red
        Me.GCursorLabel.gTextBox = New System.Drawing.Size(100, 30)
        Me.GCursorLabel.gTextBoxColor = System.Drawing.Color.Blue
        Me.GCursorLabel.gTextColor = System.Drawing.Color.Blue
        Me.GCursorLabel.gTextFade = gCursorLib.gCursor.eTextFade.Solid
        Me.GCursorLabel.gTextMultiline = False
        Me.GCursorLabel.gTextShadow = False
        Me.GCursorLabel.gTextShadowColor = System.Drawing.Color.Black
        TextShadower3.Alignment = System.Drawing.ContentAlignment.MiddleCenter
        TextShadower3.Blur = 2.0!
        TextShadower3.Font = New System.Drawing.Font("Arial", 10.0!, System.Drawing.FontStyle.Bold)
        TextShadower3.Offset = CType(resources.GetObject("TextShadower3.Offset"), System.Drawing.PointF)
        TextShadower3.Padding = New System.Windows.Forms.Padding(0)
        TextShadower3.ShadowColor = System.Drawing.Color.Black
        TextShadower3.ShadowTransp = 128
        TextShadower3.Text = "Drop Shadow"
        TextShadower3.TextColor = System.Drawing.Color.Blue
        Me.GCursorLabel.gTextShadower = TextShadower3
        Me.GCursorLabel.gTTransp = 0
        Me.GCursorLabel.gType = gCursorLib.gCursor.eType.Text
        '
        'Form1
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(371, 380)
        Me.Controls.Add(Me.TableLayoutPanel1)
        Me.Name = "Form1"
        Me.ShowIcon = False
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "Drag and Drop"
        Me.TableLayoutPanel1.ResumeLayout(False)
        Me.ResumeLayout(False)

    End Sub

    Friend WithEvents TableLayoutPanel1 As TableLayoutPanel
    Friend WithEvents Panel1 As Panel
    Friend WithEvents GCursorLabel As gCursorLib.gCursor
End Class
