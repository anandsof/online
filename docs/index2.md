# Drag And Drop Controls Using Vb.Net
## How to darg and drop controls at runtime in VB.net
### Contents

**1. Introduction**

&emsp;1.1 Simple Definition for Drag & Drop

&emsp;1.2 How drag n drop works

&emsp;1.3 Properties and methods of drag and drop

&emsp;1.4 System Requirements
      
**2. Drag & Drop Operation-a Simple Examples**

&emsp;2.1 Simple example for Drag & Drop type operation
      
&emsp;2.2 Downloadable Zip File
      
**3. VB.net Drag and drop type operation-Another Example**

&emsp;3.1 Explains how example2 is Different from Example1

&emsp;3.2 Downloadable Zip File

**4. An advanced use of Drag-n-drop in VB.net application with example**

&emsp;4.1 Brief Description

&emsp;4.2 Downloadable Zip File
   
**5. References**

&emsp;5.1 Reference
      
      
**1. Introduction**

&ensp; **1.1. Simple definition for drag & drop**
  
In computer graphical user interface drag & drop is the action of clicking on an object (virtual object on the screen) and dragging itto different location            (on screen) as required.

  The basic sequence involved in drag & drop is

  1. Press and hold down the button on the mouse or the other pointing device to “grab” the object.
  2. Drag” the object/cursor/pointing device to the desired location.
  3. “Drop”the object by releasing the button.

  Example:

  A simple drag & drop sequence is given below.

  Fig1 contains 2 columns: first column contains animal names and second column contains small boxes where relevant images are dropped.
  
  ![img1_dragndrop](https://user-images.githubusercontent.com/99252442/165729500-df65bf76-12af-44b5-ae54-3a0c89099a68.jpg)
  
  Fig 1: Images before being dragged to the target

 ![img2_dragndrop](https://user-images.githubusercontent.com/99252442/165742119-d316da29-a933-40a7-ab61-65a9eb86c7c0.jpg)
 
 Fig2. Images after being dragged to the target

  **1.2 How Drag and Drop works**

  Drag and drop is actually the same as cutting and pasting (or copying and pasting) using the mouse instead of keyboard. In both cases you have source (where you 
 are cutting or copying from) and a target (where you are pasting to). During either operation, a copy of the data is maintained in memory. Cut and paste uses 
 clipboard; drag and drop uses a data object, which is in essence private clipboard.

 **1.3 Properties and methods of Drag & drop**

Here is the sequence of events in drag and drop operation:

1. Dragging is initiated by calling DoDragDrop method for source control.

The DoDragDrop method takes 2 parameters

1. Data, specifying the data to pass

2. Allowed effects, specifying which operations (copying and/or moving) are allowed

2. A new data object is automatically created.

1. This in turn raises GiveFeedback event. In most cases you do not need to worry about Givefeedback event,but if you wanted to display a custom mouse pointer during the drag, this is where you would add your code.

2. Any control with its AllowDrop property is set to true is potential drop target. AllowDrop property can be set at design time or programmatically at Form Load event.

3. As the mouse passes over each control, the DragEnter event from that control is raised. GetDatPresent method is used to make sure that format of data is appropriate to the target control and Effect property is used to display the appropriate mouse pointer.

4. If the user releases the mouse button over a valid drop target, the DragDrop event is raised. Code in the DragDrop event handler extracts the data from the DataObject object and displays it in the target control.

**1.4. System Requirement**

The example code given in the tutorial runs on any Windows computer running windows7, XP, vista. Project is done in Visual Basic. Net. VB programmers primarily intend the tutorial for use, and you may be requiring VB.net software installed on your computer to run the program.


**Example One Drag And Drop Controls Using Vb.Net**


**2. Drag and Drop operation-simple example**

 &emsp;**2.1. Basic drag & drop operation example**

Let's look at some examples, starting with simple drag and drop operation. Create a Visual Basic.net windows application and design a form with control & Drag Drop event procedure as follows

To enable drag & drop for text

1. Place two textboxes and set Allowdrop property of a second textbox to true.
2. Add the following code

Dim MouseIsDown As Boolean
Dim m_MouseIsDown As Boolean

Private Sub TextBox1_GiveFeedback(ByVal sender As Object, ByVal e As System.Windows.Forms.GiveFeedbackEventArgs) Handles TextBox1.GiveFeedback
        e.UseDefaultCursors = False

        If ((e.Effect And DragDropEffects.Move) = DragDropEffects.Move) Then
            Cursor.Current = New Cursor(Me.Icon.Handle)
        Else
            Cursor.Current = System.Windows.Forms.Cursors.Hand   'System.Windows.Forms.Cursors.Default
        End If
    End Sub

    Private Sub TextBox1_MouseDown(ByVal sender As Object, ByVal e As System.Windows.Forms.MouseEventArgs) Handles TextBox1.MouseDown
        ' Set a flag to show that the mouse is down.
        MouseIsDown = True
    End Sub

Private Sub TextBox1_MouseMove(ByVal sender As Object, ByVal e As System.Windows.Forms.MouseEventArgs) Handles TextBox1.MouseMove
        If MouseIsDown Then
            ' Initiate dragging.
            TextBox1.DoDragDrop(TextBox1.Text, DragDropEffects.Copy)
        End If
        MouseIsDown = False

    End Sub

Private Sub TextBox2_DragDrop(ByVal sender As Object, ByVal e As System.Windows.Forms.DragEventArgs) Handles TextBox2.DragDrop
        ' Paste the text.
        TextBox2.Text = e.Data.GetData(DataFormats.Text)
    End Sub

Private Sub TextBox2_DragEnter(ByVal sender As Object, ByVal e As System.Windows.Forms.DragEventArgs) Handles TextBox2.DragEnter
        ' Check the format of the data being dropped.
        If (e.Data.GetDataPresent(DataFormats.Text)) Then
            ' Display the copy cursor.
            e.Effect = DragDropEffects.Copy
        Else
            ' Display the no-drop cursor.
            e.Effect = DragDropEffects.None
        End If
    End Sub

In the above example, the MouseDown event is used to set a flag showing that the mouse is down, and then the DoDragDrop method is called in the MouseMove event. Although you could initiate the drag in the MouseDown event, doing so would create undesirable behavior: Every time a user clicks the control, the no-drag cursor would be displayed.

The DoDragDrop method takes two parameters:

Data parameter, which in this case takes the Text property of the TextBox

allowedEffects parameter, which in this case only allows copying

Also in the MouseMove event the MouseIsDown flag is set to False. Although unnecessary in this example, if you had multiple controls that support dragging you could get a run-time exception.

In the DragEnter event, the GetDataPresent method checks the format of the data being dragged. In this case it is text, so the Effect property is set to Copy, which in turn displays the copy cursor.

In the DragDrop event, the GetData method is used to retrieve the text from the DataObject and assign it to the target TextBox.

The next section provides an example of dragging a different type of data and providing support for both cutting and copying.

To enable drag and drop for a picture

1. Add two picturebox control to a form
2. Add the following code.

Private Sub PictureBox1_MouseDown(ByVal sender As Object, ByVal e As System.Windows.Forms.MouseEventArgs) Handles PictureBox1.MouseDown
        If Not PictureBox1.Image Is Nothing Then
            ' Set a flag to show that the mouse is down.
            m_MouseIsDown = True
        End If
End Sub

Private Sub PictureBox1_MouseMove(ByVal sender As Object, ByVal e As System.Windows.Forms.MouseEventArgs) Handles PictureBox1.MouseMove
        If m_MouseIsDown Then
            ' Initiate dragging and allow either copy or move.
            PictureBox1.DoDragDrop(PictureBox1.Image, DragDropEffects.Copy Or DragDropEffects.Move)
        End If
        m_MouseIsDown = False
End Sub

Private Sub PictureBox2_DragDrop(ByVal sender As Object, ByVal e As System.Windows.Forms.DragEventArgs) Handles PictureBox2.DragDrop
        ' Assign the image to the PictureBox.
        PictureBox2.Image = e.Data.GetData(DataFormats.Bitmap)
        ' If the CTRL key is not pressed, delete the source picture.
        If Not e.KeyState = 8 Then
            PictureBox1.Image = Nothing
        End If
End Sub

Private Sub PictureBox2_DragEnter(ByVal sender As Object, ByVal e As System.Windows.Forms.DragEventArgs) Handles PictureBox2.DragEnter
        If e.Data.GetDataPresent(DataFormats.Bitmap) Then
            ' Check for the CTRL key.
            If e.KeyState = 9 Then
                e.Effect = DragDropEffects.Copy
            Else
                e.Effect = DragDropEffects.Move
            End If
        Else
            e.Effect = DragDropEffects.None
        End If
End Sub

Private Sub Form1_Load(ByVal sender As Object, ByVal e As System.EventArgs) Handles     Me.Load
        PictureBox2.AllowDrop = True
End Sub

In the above example, note that the AllowDrop property for the second PictureBox control is set in the Form1_Load event. This is necessary because the AllowDrop property is not available at design time.

In the MouseDown event, the code first checks to make sure that there is an image assigned to the PictureBox; otherwise, after you moved the picture, subsequent clicks would raise an exception.

Also note that in both the DragEnter and DragDrop events the code checks to see if the CTRL key is pressed to determine whether to copy or move the picture. Why are the values different? In the DragEnter event, the left mouse button is down, resulting in a value of 8 for the CTRL key plus 1 for the left mouse button. For a list of KeyState enumerations, see DragEventArgs.KeyState Property.

Both examples so far have dealt with dragging between two controls on the same form; they would also work for dragging items between controls on different forms within an application. The next example demonstrates accepting items dropped from another application - in this case, files that are dragged from Windows Explorer.
Screen shots for the above example is as shown below
  
  ![img3_dragndrop](https://user-images.githubusercontent.com/99252442/165742802-f965d794-9fa2-4b07-b2d8-a47f92be60ef.jpg)
  
  Fig1: Screenshot for example1 control before being dragged to a target
  
![img4_dragndrop](https://user-images.githubusercontent.com/99252442/165743325-e7724f6a-193c-4e14-b2a4-1ee749ca61b6.jpg)

Fig2: Screenshot for example1 control after being dragged to a target

 &emsp;**2.2 Downloadable zip file**

[simpledraganddropdemo.zip](https://github.com/Shanthala-K/DragnDropExamples/files/8582272/simpledraganddropdemo.zip)

**Example Two Drag And Drop Controls Using Vb.Net**

**3. Another Example for drag and drop type operation- Example2**

 &emsp;**3.1. Explains how example2 is different from example1**

This example explains how drag & drop is performed for different type of formats.
Dragging operation i.e. dragging the control from source to destination is same as what is explained in Example1 that means same event procedures are used to perform Drag & Drop operation.
In Example1 simple images are simple images are dragged from one place to another
i.e. dragged from source & dropped on to appropriate places (target).
But in this example array of controls created dynamically at runtime based on the number of options. Answer options controls are also created dynamically (minimum 8 option) and then dragged to a appropriate place.

To grab the more information about this download the appropriate zip file.
Screen shots for example2 is given below

![img5_dragndrop](https://user-images.githubusercontent.com/99252442/165885747-75d90958-2535-4f11-99d3-6ce775033080.jpg)

Fig3: Screenshot for match the following type question
Controls before being dragged to a target
Here boxes given in pink color are dragged and dropped in the target (placeholder boxes).

![img6_dragndrop](https://user-images.githubusercontent.com/99252442/165885774-9c3e9f94-2bd0-460d-b5de-c8073b059eb7.jpg)

Fig4: Screenshot fro example2 controls after being dragged to a target

 &emsp;**3.2 Downloadable zip file**

[dragdrop-example2.zip](https://github.com/Shanthala-K/DragnDropExamples/files/8588175/dragdrop-example2.zip)

**4. Example3 for Drag & drop type question**

 &emsp;;**4.1 Brief description of example3**

 Example 3 is slightly different from Example2.

 This example (project) contains Drag & Drop for fill in the blanks type questions.

 Also it explains how to display the blank spaces in middle of the question

Here control for questions, control for placeholder and control for answer option is created at runtime as control array

(i.e. minimum no. of option given are 12)

These options are dragged and dropped on the required places.

For more information about this example you can download a zip file.

Screen shots for example3 is given below

![img7_dragndrop](https://user-images.githubusercontent.com/99252442/165886259-5e8398ec-3fcb-4dc5-be5a-582ea262832a.jpg)
      
Fig5: Screenshot for example3 controls before being dragged to the target.
      
![img7_dragndrop](https://user-images.githubusercontent.com/99252442/165886306-1265d2ff-d3c1-4d75-a35d-836078d6652e.jpg)
      
Fig6: screenshot for example3 control after being dragged to a target.

**4.2 Downloadable zip file**

  [draganddrop-example3.zip](https://github.com/Shanthala-K/DragnDropExamples/files/8588302/draganddrop-example3.zip)
   
      
 **5. References**  
    
  &emsp;**5.1 Microsoft Visual studio 2013 MSDN**

Check out this link for more details

https://www.tutorialsweb.com/dragndrop_tut/vbdotnet-1.htm

