
#!/usr/bin/env python
#import pandas as pd
#import math
import sys
import json
myfile = open('/tmp/data.json','w+')

#with open(sys.argv[1], 'r') as f:
#    contents = f.read()

Range1 = 0
Range2 = 0

range3 = True
Symmetry = False
#remember to change input to raw_input
#input1 = raw_input()
# in Python 3, raw_input() was renamed to input()

def preprocess_input(input_string):
    input_string = input_string.upper()  # Convert all characters to uppercase
    # input_string = input_string.replace(" ", "")
    valid_chars = set("AGCT")
    cleaned_input = "".join(char for char in input_string if char in valid_chars)
    return cleaned_input


input1 = input()
int1 = input1.split(" ")
print(int1)
MinValue = int1[0]
int(MinValue)
MaxValue = int1[1]
int(MaxValue)
MinTm = int1[2]
int(MinTm)
MaxTm = int1[3]
int(MaxTm)
purValue = int1[4]
int(purValue)
for i in range(4):
  int1.pop(0)
InsertString = "".join(int1)
# InsertString = int1[5]
InsertString = preprocess_input(InsertString)
were = len(InsertString)
str(InsertString)
print(were)
print(InsertString)

lentt = len(InsertString) + 1


Printer = True

#print(" \n")
scannercounter = 0

Min = int(MinValue)

  
def TMFinder(zed):
  global Symmetry
  global Printer
  zed1 = ""
  for ele in zed:
    zed1 += ele
  zed1 = zed1.strip()
  array = [zed1[i:i+2] for i in range(0, len(zed1), 1)]
  #print("Splitted Array: " + str(array))

  array1 = []
  for x in zed:
    array1.append(x)

  length = len(array1)
 
  A = 0
  T = 0
  G = 0
  C = 0
  Length = len(x)
  for item in array1:
    if item == "A":
      A += 1
    if item == "T":
      T += 1
    if item == "G":
      G += 1
    if item == "C":
      C += 1 

  def ln(x):
    val = x
    return 99999999*(x**(1/99999999)-1)


  

  HS = {
  # -43.5
  "AA" :  -7.9,  
  "AT" :  -7.2,  
  "TA" :  -7.2, 
  "CA" :  -8.5,  
  "GT" :  -8.4,  
  "CT" :  -7.8,  
  "GA" :  -8.2,  
  "CG" :  -10.6,  
  "GC" :  -9.8, 
  "GG" :  -8.0,  
  "TT" :  -7.9,  #
  "TG" :  -8.5,  #
  "AC" :  -8.4,  
  "AG" :  -7.8,  
  "TC" :  -8.2,  
  "CC" :  -8.0

  # INI"H GC" : "0.1",
  # INI"H AT" : "2.3", 
  # SYM"H" : "0.0"

  }
  SS = {
  #-122.5
  "AA" : -22.2,
  "AT" : -20.4,
  "TA" : -21.3,
  "CA" : -22.7,
  "GT" : -22.4,
  "CT" : -21.0,
  "GA" : -22.2,
  "CG" : -27.2,
  "GC" : -24.4,
  "GG" : -19.9,
  "TT" : -22.2, #
  "TG" : -22.7, #
  "AC" : -22.4,
  "AG" : -21.0,
  "TC" : -22.2,
  "CC" : -19.9  
  # INI"S GC" : "-2.8",
  # INI"S AT" : "4.1",
  # SYM"S" : "-1.4"

  }
  GS = {
  "AA" : -1.00,
  "AT" : -0.88,
  "TA" : -0.58,
  "CA" : -1.45,
  "GT" : -1.44,
  "CT" : -1.28,
  "GA" : -1.30,
  "CG" : -2.17,
  "GC" : -2.24,
  "GG" : -1.84,
  "TT" : -1.00, #
  "TG" : -1.45, #
  "AC" : -1.44, 
  "AG" : -1.28, 
  "TC" : -1.30,
  "CC" : -1.84
  #INI"G GC" : "0.98",
  #INI"G AT" : "1.03",
  # SYM"G" : "0.4",

  }
          #  f = 1000delH/(delS+1.987log(C/4)) - 273.15;
          


  DeltaH = 0
  for i in array:
    if i in HS:
      DeltaH += HS[i] 


  DeltaS = 0
  for i in array:
    if i in SS:
      DeltaS += SS[i]
      


  DeltaG = 0
  for i in array:
    if i in GS:
      DeltaG += GS[i]
      

  if array1[0] == "G" or array1[0] == "C":  
    DeltaH += 0.1
    DeltaS += -2.8
    DeltaG += 0.98
    
  if array1[length - 1] == "G" or array1[length - 1] == "C":
    DeltaH += 0.1
    DeltaS += -2.8
    DeltaG += 0.98

  if array1[0] == "A" or array1[0] == "T":
    DeltaH += 2.3
    DeltaS += 4.1
    DeltaG += 1.03
    
  if array1[length - 1] == "A" or array1[length - 1] == "T":
    DeltaH += 2.3
    DeltaS += 4.1
    DeltaG += 1.03
 
  #if Symmetry == True:
  #   DeltaS += -1.4
  #   DeltaG += 0.4

    
  R = 1.9872
  Ct = 0.0001
  x = 4
  x1 = 1
  TM = 0

  #if Printer == False:
  TM = (1000 * DeltaH) / (DeltaS + (1.987 * -10.5966347331)) - 273.15
  TM3 = 20.79 + (0.83*TM) + (-26.13 * (float(float((C + T)) / length))) + (0.44 * length)
  TM1 = str(round(TM3, 1))
  #return TM1, DeltaS, DeltaH, DeltaG
  #print("TM Value: " + str(TM1))
  #print("Delta S: " + str(round(DeltaS, 2)))
  #print("Delta H: " + str(round(DeltaH, 2)))
  #print("Delta G: " + str(round(DeltaG, 2)))
  if TM3 > float(MinTm) and TM3 < float(MaxTm) and Printer == True:
    Sequences["TM"].append(TM1)
    
  else:
    #print("TM Out of Range")
    #return "Comment: TM out of range"
    Printer = False
        



Sequences = {
  "Sequence Number" : [],
  "Sequence" : [],
  "Base Count" : [],
  "Purine Stretch" : [],
  "Purine Content" : [],
  "TM" : [],
  "Position" : []
}




array = []
for x in InsertString:
  array.append(x)
for a in array[:]:
    if a != "A" and a != "C" and a != "G" and a != "T":
        array.remove(a)
        if a != " ":
          pass
            #print("Warning, illegal characters deleted.")
#print(array)
#Min = int(MinValue)


Max = int(MaxValue)
Len = len(array)
if Max >= Len:
    Max = Len
def ComplementarySequence(Insert):
  global Symmetry
  # Insert = Insert.upper()
  
  array = []
  for x in Insert:
    array.append(x)
  ComplementarySequence = []
  lists = []

  Min = 4
  Max = len(array)
  Symmetry1 = True
  array1 = []
  for a in Insert:
    array1.append(a) 
  array1.reverse()
  for index, item in enumerate(array1):
    if item == "A":
      array1[index] = "T"
    elif item == "T":
      array1[index] = "A"
    elif item == "C":
      array1[index] = "G"
    elif item == "G":
      array1[index] = "C"
  for index, item in enumerate(array1):
    if array1[index] == array[index]:
      pass
    else:
      Symmetry1 = False
  if Symmetry1 == True:
    Symmetry = True
    
  str2 = ""
  for w in array1:
    str2 += w
  #print("Reverse Complement Sequence: " + str2)
  #return str2
  def ArrayMaker(X, Y, Z):
    
    X -= 1
    Z = array[X:Y]
    str = ""
    str.upper()
    for r in Z:
      str += r
    
    variable = True
    First = 0
    First1 = 0
    SelfComplement = 0
    yet = 0
    
    str1 = " "
    while variable == True:
      
      try:
        if Z[First] == array1[First1]:
          SelfComplement += 1
          First += 1
          First1 += 1
          if SelfComplement == len(Z):
            for ele in Z:  
              str1 += ele
            
            ComplementarySequence.append(str1) 
            SelfComplement = 0
            
        elif Z[First] != array1[First1]:
          First = 0
          yet += 1
          First1 = yet
          SelfComplement = 0
        else:
          variable = False
      except IndexError:
        variable = False
    
    [lists.append(v) for v in ComplementarySequence if v not in lists]
  

  global Printer
  
    

  def StrCreater(z, y):
    x = 1
    Min1 = Min + z
    repeat = True
    
    while repeat == True:
      if x <= Max - Min + y:
        ArrayMaker(x, Min1, x)
        x = x + 1
        Min1 = Min1 + 1
      else: 
        repeat = False

  def player1():
    Min1 = Min
    Max1 = Max
    x = 0
    c = 1
    while(Min1 <= Max1):
      StrCreater(x, c)
      Min1 = Min1 + 1
      x = x + 1
      c = c - 1

  player1()
  Complement = False
  listToStr = ','.join([str(elem) for elem in ComplementarySequence]) 
  for xar in ComplementarySequence:
    if len(xar) >= 8:
      Printer = False
      if Complement == False:
        Complement = True
        #print("Complementarity Sequence Above 6 Base Pairs Detected")
        return
  Complement = False
    
  #print("Complementary Sequences:" + str(listToStr))
  #return listToStr
  
def scanner(x): 
  global Printer
  global Symmetry
  global Range1
  global Range2
  global range3
  scan = True
  A = 0
  T = 0
  G = 0
  C = 0
  Length = len(x)
  for item in x:
    if item == "A":
      A += 1
    if item == "T":
      T += 1
    if item == "G":
      G += 1
    if item == "C":
      C += 1 
  

    purineStretch = 0
    purineStretch1 = 0
    descisionFactor = 1
    a = 0
  while scan == True:
    try:
      if descisionFactor == 1 and (x[a] == "A" or x[a] == "G"):
        purineStretch += 1
        a += 1
      elif descisionFactor == -1 and (x[a] == "A" or x[a] == "G"):
        purineStretch1 += 1
        a += 1
      else:
        if purineStretch > purineStretch1:
          purineStretch1 = 0
          descisionFactor = -1
        else:
          purineStretch = 0
          descisionFactor = 1
        a += 1
    except IndexError:
      scan = False
  purineContent = str(round((((float(A + G)) / Length) * 100), 2))
  if purineContent > purValue:
    Printer = False
  BiggestPurineStretch = 0
  if scan == False:
    if purineStretch > purineStretch1:
      BiggestPurineStretch = purineStretch
    else:
      BiggestPurineStretch = purineStretch1
  if BiggestPurineStretch >= 6:
    Printer = False
    #print("Purine Stretch is 6 or larger")
  ComplementarySequence(x)
  TMFinder(x)
  
  if Printer == True and BiggestPurineStretch < 6:
    Sequences["Purine Stretch"].append(BiggestPurineStretch)
    Sequences["Purine Content"].append(purineContent)


  
  str1 = ""
  
  for w in x:
    str1 += w
  if Printer == True:
    Sequences["Sequence"].append(str1)
  res = ' '.join(str1[i:i + 3] for i in range(0, len(str1), 3))
  global scannercounter
  
  
  if Printer == True:
    scannercounter += 1
    Sequences["Sequence Number"].append(scannercounter)
    Sequences["Base Count"].append(Length)
    if Range1 == 0 and Range2 == 0:
      Sequences["Position"].append("1" + " - " + str(MinValue))
    else:
      temp1 = Range1
      temp2 = Range2
      if Range1 == were + 1:
        temp1 = Range1 - were
        temp2 = Range2 - were + 1
      Sequences["Position"].append(str(temp1) + " - " + str(temp2))
    
  

  
  
  #print("Complete Sequence: " + res)
  #print("Base Composition: ")
  #print("A = " + str(A) + " (" + str(round(((A / Length) * 100), 2)) + "%)")
  #print("T = " + str(T) + " (" + str(round(((T / Length) * 100), 2)) + "%)")
  #print("G = " + str(G) + " (" + str(round(((G / Length) * 100), 2)) + "%)")
  #print("A = " + str(C) + " (" + str(round(((A / Length) * 100), 2)) + "%)")
  #print("Base Count: " + str(Length))
  #print("Purine Stretch: " + str(BiggestPurineStretch))
  
  #print("Purine Content: " + purineContent + " \n \n")
  Printer = True
  Symmetry = False

def ArrayMaker(X, Y, Z):
  X -= 1
  Z = array[X : Y]
  str = ""
  str.upper()
  for r in Z:
    str += r
  try: 
    array[Y - 1] = array[Y - 1]
  except IndexError:
    return
  scanner(Z)

def StrCreater(z, y):
  global Range1
  global Range2
  x = 1
  Min1 = Min + z
  repeat = True
  #print(Min1)
  
  while x <= len(array):
    ArrayMaker(x , Min1, x)
    x += 1
    Min1 += 1
    Range1 = x
    Range2 = Min1

def player():
  global Range1
  global Range2
  Min1 = Min
  Max1 = Max
   
  x = 0
  c = 1
  while (Min1 <= Max1):
    StrCreater(x, c)
    Min1 += 1
    x += 1
    c -= 1

player()
print(Sequences)
json.dump(Sequences,myfile)
myfile.close()

#with open(outFile,'w') as o:
#    for line in processedLines:
#        o.write(line)
#Table = pd.DataFrame(Sequences, columns = ['Sequence Number', 'Sequence', 'Length', 'Purine Content', 'TM'])
#Table.set_index('Sequence Number', inplace=True)
#print(Table)
