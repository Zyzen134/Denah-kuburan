import { db } from '@/db';
import { deceased, graves, blocks, relatives } from '@/db/schema';
import { NextResponse } from 'next/server';
import { eq } from 'drizzle-orm';

export async function GET(
  request: Request,
  { params }: { params: Promise<{ id: string }> }
) {
  try {
    const { id } = await params;
    const deceasedId = parseInt(id);

    const deceasedData = await db.select({
      id: deceased.id,
      graveId: deceased.graveId,
      fullName: deceased.fullName,
      birthDate: deceased.birthDate,
      deathDate: deceased.deathDate,
      age: deceased.age,
      biography: deceased.biography,
      photo: deceased.photo,
      plotNumber: graves.plotNumber,
      blockName: blocks.name,
      row: graves.row,
      column: graves.column,
    })
    .from(deceased)
    .leftJoin(graves, eq(deceased.graveId, graves.id))
    .leftJoin(blocks, eq(graves.blockId, blocks.id))
    .where(eq(deceased.id, deceasedId))
    .limit(1);

    if (deceasedData.length === 0) {
      return NextResponse.json({ error: 'Not found' }, { status: 404 });
    }

    const relativesList = await db.select()
      .from(relatives)
      .where(eq(relatives.deceasedId, deceasedId));

    return NextResponse.json({
      ...deceasedData[0],
      relatives: relativesList,
    });
  } catch (error) {
    console.error('Error fetching deceased details:', error);
    return NextResponse.json({ error: 'Failed to fetch deceased details' }, { status: 500 });
  }
}
